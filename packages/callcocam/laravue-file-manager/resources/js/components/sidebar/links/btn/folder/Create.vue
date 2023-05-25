<template>
    <div class="mt-2 px-4 ">
        <f-btn-primary  @click="openModal" rounded>
            <f-icons-icon name="fa-folder-plus" class="h-4.5 w-4.5" />
            <span> {{ $t('Create New') }} </span>
        </f-btn-primary>
        <f-modal :isOpen="isOpen" @closeModal="closeModal">
            <template v-slot:header>
                {{ $t('Create new folder') }}
            </template>
            <label class="block">
                <textarea v-model="form.name" :placeholder="$t('Enter folder name')"
                    class="form-textarea w-full resize-none rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"></textarea>
            </label>
            <template v-slot:footer>
                <f-btn-primary @click="create(directory)" rounded>
                    {{ $t('Apply') }}
                </f-btn-primary>
            </template>
        </f-modal>
    </div>
</template>
<script setup>
import { ref, computed, reactive, inject } from 'vue'
import { useManagerDirStore } from '@file-manager/stores/dirs';
import { useManagerFilesStore } from '@file-manager/stores/files';

const APIHttp = inject('APIHttp')
const { setLoading } = useManagerFilesStore()
const { loadStoreDirs } = useManagerDirStore()
const directory = computed(() => useManagerDirStore().directory)
const form = reactive({ name: '' })
const isOpen = ref(false)

function closeModal() {
    isOpen.value = false
}
function openModal() {
    isOpen.value = true
}
async function create(directory) {

    const formData = new FormData()
    if (directory.hasOwnProperty('id')) {
        formData.append('file_manager_id', directory.id)
    }
    formData.append('name', form.name)
    if (directory.hasOwnProperty('path')) {
        let pathAndUrl = directory.path.concat('/').concat(form.name).replace('//', '/').replace('//', '/')
        formData.append('path', pathAndUrl)
        formData.append('url', pathAndUrl)
    } else {
        let pathAndUrl = ('file_managers').concat('/').concat(form.name).replace('//', '/').replace('//', '/')
        formData.append('path', pathAndUrl)
        formData.append('url', pathAndUrl)
    }
    setLoading(true)
    try {
        await APIHttp.createServiceFolder(formData)
        form.name = ''
        await loadStoreDirs(APIHttp, { type: 'dir' })
        setLoading(false)
        closeModal()
    } catch (e) {
        console.log(e)
        setLoading(false)
    }
}
</script>