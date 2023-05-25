<template>
    <li>
        <template v-if="previews && previews.length">
            <f-sidebar-links-links :directory="directory" />
        </template>
        <template v-else>
            <f-sidebar-links-btn-main>
                <div class="mr-1 flex h-5 w-5 items-center justify-center"></div>
                <f-sidebar-links-btn-folder @onExpanded="onExpanded" :previews="previews" :isExpanded="obj.expanded">
                    <button class="flex w-full" type="button" @click="onClick(directory.id)">
                        <f-icons-icon name="fa-folder-open" class="mr-3 h-6 w-6 text-warning" />
                        <span> {{ directory.name }}</span>
                    </button>
                </f-sidebar-links-btn-folder>
            </f-sidebar-links-btn-main>
        </template>
    </li>
</template>
<script setup>
import { reactive, inject } from 'vue'
import { useManagerParamsStore } from '@file-manager/stores/params'
import { useManagerDirStore } from '@file-manager/stores/dirs'
import { useManagerFilesStore } from '@file-manager/stores/files'

const { setParams, hasParam, resetParam } = useManagerParamsStore()

const APIHttp = inject('APIHttp')

const props = defineProps({
    directory: {
        type: Object
    },
})
const { previews } = props.directory

const { setDirectory } = useManagerDirStore()
const { loadStoreFiles } = useManagerFilesStore()


const onExpanded = (event) => {
    obj.expanded = event
}
const onClick = async (file_manager_id) => {
    obj.expanded = true
    
    setDirectory(props.directory)
    if (hasParam(file_manager_id)) {
        resetParam(file_manager_id)
        await loadFiles()
    } else {
        setParams({ file_manager_id })
        await loadFiles({ file_manager_id })
    }
}

const loadFiles = (async (params = {}) => {
    await loadStoreFiles(APIHttp, Object.assign(useManagerParamsStore().params, params))
})
</script>