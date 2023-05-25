<template>
    <div class="flex h-full  grow flex-col bg-white  dark:bg-navy-750">
        <f-sidebar-panel  >
            <div>
                <f-sidebar-links-btn-filters  />
                <div>
                    <ul class="mt-1 space-y-1 px-2 font-inter text-xs+ font-medium">
                        <template v-for="directory in directories" :key="directory.id">
                            <f-sidebar-links-links :directory="directory" @onLoadFiles="loadFiles" />
                        </template>
                    </ul>
                </div>
            </div>
            <div class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>
            <f-sidebar-filters @onLoadFiles="loadFiles" />
        </f-sidebar-panel>
        <f-sidebar-minimized @onLoadFiles="loadFiles" />
    </div>
</template>
<script setup>
import { computed, inject } from 'vue'

import { useManagerParamsStore } from "@file-manager/stores/params"

import { useManagerDirStore } from "@file-manager/stores/dirs"

import { useManagerFilesStore } from '@file-manager/stores/files'

const APIHttp = inject('APIHttp')

const props = defineProps({
    context: {
        type: Object,
        default: {}
    }
})

const directories = computed(() => useManagerDirStore().dirs)

const { loadStoreFiles } = useManagerFilesStore()


const loadFiles = (async (params = {}) => {

    await loadStoreFiles(APIHttp, Object.assign(useManagerParamsStore().params, params))
})
</script>