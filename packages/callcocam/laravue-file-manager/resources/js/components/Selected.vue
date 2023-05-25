<template>
    <div class="flex items-center space-x-4 w-full md:max-w-xl truncate text-ellipsis overflow-hidden">
        <slot />
        <div class="flex flex-col w-full justify-center items-center">
            <span class="text-xs flex"> {{ size }} </span>
            <span class="text-xs flex"> {{ time }} </span>
        </div>
    </div>
</template>

<script setup>
import { computed, inject } from 'vue'
import { useManagerDirStore } from '@file-manager/stores/dirs';
import { useManagerSelectedStore } from '@file-manager/stores/selected';
import { useManagerFilesStore } from '@file-manager/stores/files'
import { useManagerParamsStore } from '@file-manager/stores/params';

const APIHttp = inject('APIHttp')

const props = defineProps({
    file: {
        type: Object
    }
})
const sel = useManagerSelectedStore()
const { type, id, size, name, url, icon, updated_at, time, deleted_at } = props.file
const { loadStoreFiles } = useManagerFilesStore()
const active = computed(() => useManagerDirStore().directory)


const selectAction = async (type, id, page, file_manager_id) => {
    if (type == 'dir') {
        sel.setDirectory(props.file)
        await loadStoreFiles(APIHttp, { type: 'file', page, file_manager_id })
    }
    else {
        if (sel.selected.find(v => v == id)) {
            sel.clearSelected(id)
        } else {
            sel.selectedFiles(id)
            const formData = new FormData();
            formData.append('recent', moment().format('YYYY-MM-DD h:mm:ss'))
            formData.append('updated_at', moment().format('YYYY-MM-DD h:mm:ss'))
            const { data } = await APIHttp.updatedServiceFile(id, formData)
        }
    }
}
</script>