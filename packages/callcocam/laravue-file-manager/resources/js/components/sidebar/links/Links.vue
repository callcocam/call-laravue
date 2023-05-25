<template>
    <li>
        <f-sidebar-links-btn-main>
            <f-sidebar-links-btn-folder @onExpanded="onExpanded($event)" :previews="previews" :isExpanded="obj.expanded">
                <button :class="{ 'text-sky-600': isSelected(directory, selectedDir) }" class="flex w-full "
                    type="button" @click="onClick(directory.id)">
                    <f-icons-icon name="fa-folder" class="mr-3 h-6 w-6 text-warning" />
                    <span> {{ directory.name }}</span>
                </button>
            </f-sidebar-links-btn-folder>
        </f-sidebar-links-btn-main>
        <ul v-show="obj.expanded" class="pl-4 transition-transform">
            <TransitionRoot :show="obj.expanded">
                <template v-for="(preview, index) in previews" :key="index">
                    <f-sidebar-links-links :directory="preview" />
                </template>
            </TransitionRoot>
        </ul>
    </li>
</template>
<script setup>

import { reactive, inject, ref, onMounted } from 'vue'
import { TransitionRoot } from '@headlessui/vue'
import { useManagerDirStore } from '@file-manager/stores/dirs'
import { useManagerParamsStore } from '@file-manager/stores/params'
import { useManagerFilesStore } from '@file-manager/stores/files'
const APIHttp = inject('APIHttp')
const props = defineProps({
    directory: {
        type: Object,
    },
})
const { previews } = props.directory

const selectedDir = ref(useManagerDirStore().directory)
const obj = reactive({
    expanded: false
})
const { loadStoreFiles } = useManagerFilesStore()

const { setDirectory } = useManagerDirStore()

const { setParams, hasParam, resetParam } = useManagerParamsStore()

const isSelected = (d, s) => {
    return d.id === s.file_manager_id || d.id === s.id
}

const onExpanded = (event) => {
    obj.expanded = event
}

const onClick = async (file_manager_id) => {
    obj.expanded = true
    setDirectory(props.directory)
    if (hasParam(file_manager_id)) {
        resetParam(file_manager_id)
        await loadFiles({})
    } else {
        setParams({ file_manager_id })
        await loadFiles({ file_manager_id })
    }
}
const loadFiles = (async (params = {}) => {
    await loadStoreFiles(APIHttp, Object.assign(useManagerParamsStore().params, params))
})
onMounted(() => {
    if (selectedDir.value.hasOwnProperty('file_manager_id') && selectedDir.value.id === props.directory.file_manager_id) {
        obj.expanded = true
    } else if (selectedDir.value.file_manager_id === props.directory.id) {
        obj.expanded = true
    }
})
</script>