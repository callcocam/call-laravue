<template>
    <div class="flex flex-col  h-14">
        <div class="mt-4 flex items-center justify-between px-4">
            <span class="text-xs font-medium uppercase">{{ $t('MY FILES') }} </span>
            <div class="-mr-1.5 flex">
                <button
                    class="btn h-6 w-6 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <f-icons-icon name="fa-search" class="h-3 w-3" />
                </button>
                <button @click="onExpanded(!expanded)"
                    class="btn h-6 w-6 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <f-icons-icon name="fa-chevron-down" class="h-3 w-3" :class="expanded && 'rotate-180'" />
                </button>
            </div>
        </div>
        <button v-if="Object.keys(params).filter(v => !v.includes('page') && !v.includes('type')).length"
            @click="loadAllFiles"
            class="flex items-center rounded-full justify-center space-x-1 w-full font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25"
            type="button">
            <f-icons-icon name="fa-filter" class="h-3 w-3" />
            <span>{{ $t('Clear filters') }}</span>
        </button>
    </div>
</template>
<script setup>
import { ref, computed, inject } from 'vue'
const expanded = ref(false)
import { useManagerParamsStore } from '@file-manager/stores/params';
import { useManagerFilesStore } from '@file-manager/stores/files'
import { useManagerDirStore } from '@file-manager/stores/dirs'
const { loadStoreFiles } = useManagerFilesStore()
const params = computed(() => useManagerParamsStore().params)

const APIHttp = inject('APIHttp')

const { resetParams } = useManagerParamsStore()
const { setDirectory } = useManagerDirStore()

const onExpanded = (event) => {
    expanded.value = event
}

const loadAllFiles = async () => {
    setDirectory({})
    resetParams({ type: 'file' })
    await loadStoreFiles(APIHttp, Object.assign(useManagerParamsStore().params, { type: 'file' }))
}
</script>