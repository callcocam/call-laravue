<template>
    <div>
        <template v-if="isOpen">
            <f-btn-default @click="() => openModal(false)">
                <f-icons-icon name="fa-cloud-download-alt" class="h-4 w-4" />
                <span class="hidden md:block">{{ $t('Choose File') }}</span>
            </f-btn-default>
        </template>
        <template v-else>
            <f-btn-default @click="() => openModal(true)">
                <f-icons-icon name="fa-cloud-upload-alt" class="h-4 w-4" />
                <span class="hidden md:block">{{ $t('Choose File') }}</span>
            </f-btn-default>
        </template>
        <f-modal :isOpen="isOpen" @closeModal="closeModal">
            <template v-slot:header>
                {{ $t('Are you sure you want to delete the folder') }} - {{ directory.name }} ?
            </template>
            <p class="mt-1 text-slate-500 dark:text-navy-200">

                <input ref="fileInput" multiple :data-is-drag-hover="isOver" type="file" @change="handleFile"
                    @dragover="handleDragOver" @dragleave="handleDragLeave">
            </p>
            <div class="my-4 mt-6 h-px bg-slate-200 dark:bg-navy-500"></div>
            <template v-if="files.length">
                <f-uploader-upload v-for="(file, index) in files" :key="index" :file="file" />
            </template>
        </f-modal>
    </div>
</template>
<script >
import { ref, watch, computed, inject, nextTick, reactive, onMounted, onUnmounted } from 'vue'
import { useManagerDirStore } from '@file-manager/stores/dirs';
import { useManagerFilesStore } from '@file-manager/stores/files';
import { useManagerParamsStore } from '@file-manager/stores/params';
import { useManagerModalStore } from "@file-manager/stores/modal"
import { token } from '@file-manager/helpers';

export default {
    props: {
        context: {
            type: [Object],
        }
    },
    setup({ context }) {

        const directory = computed(() => useManagerDirStore().directory)
        const { loadStoreFiles, setFile } = useManagerFilesStore()
        const APIHttp = inject('APIHttp')
        const fileInput = ref(null)
        const files = ref([])
        const isOpen = ref(false)
        const isOver = ref(false)
        const form = reactive({
            file: null
        })
        function closeModal() {
            isOpen.value = false

            fileInput.value.value = null
            files.value = []
        }
        function openModal() {
            isOpen.value = true
        }
        const preventDefault = (e) => {
            if (e.target.tagName !== 'INPUT' && e.target.getAttribute('type') !== 'file') {
                e = e || event
                e.preventDefault()
            }
        }
        const handleFile = () => {
            isOver.value = false
            const input = fileInput.value
            const files = input.files;
            if (files.length) {
                addFileList(files)
            }
        }

        const addFileList = (fileList) => {
            for (let i = 0; i < fileList.length; i++) {
                const file = fileList[i]
                const uuid = token()
                files.value.push({
                    progress: false,
                    error: false,
                    complete: false,
                    justFinished: false,
                    name: file.name || 'file',
                    directory,
                    file,
                    uuid,
                    path: false,
                    removeFile: (fileData) => {
                        removeFile(fileData)
                    },
                    loadFiles: (fileData) => {
                        loadFiles(fileData)
                    },
                    selectFile: (fileData) => {
                        setFile(fileData)
                        if (fileData.hasOwnProperty('url')) {
                            useManagerModalStore().setShowModal()
                        }
                    },
                    previewData: file.previewData || false
                })

            }
        }

        const removeFile = async (fileData) => {
            const { data } = await APIHttp.deleteServiceFolder(fileData.id)
            files.value = files.value.filter(file => file && file.uuid !== fileData.uuid)
            await loadFiles()
        }

        const loadFiles = async (fileData) => {
            fileInput.value.value = null
            await loadStoreFiles(APIHttp, useManagerParamsStore().params)
        }

        const handleDragOver = (e) => {
            e.preventDefault()
            isOver.value = true
        }
        const handleDragLeave = (e) => {
            e.preventDefault()
            isOver.value = false
        }


        onMounted(() => {

            if (window && context.preventWindowDrops) {
                window.addEventListener('dragover', preventDefault)
                window.addEventListener('drop', preventDefault)
            }
        })

        onUnmounted(() => {
            if (window && context.preventWindowDrops) {
                window.removeEventListener('dragover', preventDefault)
                window.removeEventListener('drop', preventDefault)
            }
        })
        return {
            fileInput, handleFile, openModal, closeModal, handleDragLeave, handleDragOver, isOver, loadFiles, isOpen, directory, files
        }
    },
}

</script>