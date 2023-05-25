<template>
    <div>
        <f-btn-error @click="openModal" rounded>
            <f-icons-icon name="fa-regular-trash-alt" class="h-4.5 w-4.5" />
            <span> {{ $t('Remove Folder') }} </span>
        </f-btn-error>
        <f-modal :isOpen="isOpen" @closeModal="closeModal">
            <template v-slot:header>
                {{ $t('Are you sure you want to delete the folder') }} - {{ directory.name }} ?
            </template>
            <p class="mt-1 text-slate-500 dark:text-navy-200">
                {{ $t('Once the folder is deleted, all its resources and data will be permanently deleted. Before' +
                    'deleting a folder, download any data or information that you want to retain') }}
            </p>
            <div class="my-4 mt-6 h-px bg-slate-200 dark:bg-navy-500"></div>
            <template v-slot:footer>
                <f-btn-primary @click="deleteSelectFolder(directory, 1)">
                    {{ $t('Apply') }}
                </f-btn-primary>
            </template>
        </f-modal>
    </div>
</template>

<script setup>
import { ref, computed, inject } from 'vue'
import { useManagerDirStore } from '@file-manager/stores/dirs';
import { useManagerFilesStore } from '@file-manager/stores/files';

const directory = computed(() => useManagerDirStore().directory)
const { setLoading, loadStoreFiles } = useManagerFilesStore()
const { loadStoreDirs, setDirectory } = useManagerDirStore()
const APIHttp = inject('APIHttp')
const isOpen = ref(false)

function closeModal() {
    isOpen.value = false
}
function openModal() {
    isOpen.value = true
}

const deleteSelectFolder = async (directory, page) => {
    const { id, file_manager_id, type, folder } = directory
    setLoading(true)
    try {
        await APIHttp.deleteServiceFolder(id)
        await loadStoreDirs(APIHttp, { type: 'dir' })
        if (folder) {
            setDirectory(folder)
            if (!file_manager_id) file_manager_id = id
            await loadStoreFiles(APIHttp, { page, file_manager_id })
        } else {
            setDirectory({})
            await loadStoreFiles(APIHttp, { page })
        }
        setLoading(false)
        closeModal()
    } catch (e) {
        console.log(e)
        setLoading(false)
    }
}
</script>