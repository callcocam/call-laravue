<template>
    <div class="fm-sidebar-panel">
        <div class=" flex h-18 w-full items-center justify-between pl-4 pr-1">
            <div class="flex items-center">
                <div class="avatar mr-3 hidden h-9 w-9 lg:flex">
                    <div
                        class="is-initial rounded-full bg-primary/10 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>
                </div>
                <p class="text-lg font-medium tracking-wider text-slate-800 line-clamp-1 dark:text-navy-100">
                    {{ $t('My Cloud') }}
                </p>
            </div>
            <button @click="() => { }"
                class="btn h-7 w-7 rounded-full p-0 text-primary hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-accent-light/80 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 xl:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
        </div>
        <div class="flex h-[calc(100%-4.5rem)] grow flex-col">
            <div class="is-scrollbar-hidden grow overflow-y-auto">
                <f-sidebar-links-btn-folder-create />
                <slot />
            </div>
            <div class="flex flex-col p-4">
                <div class="flex items-center justify-between">
                    <p>
                        <span class="font-medium text-slate-600 dark:text-navy-100">35GB</span>
                        of 1TB
                    </p>
                    <a href="#"
                        class="text-xs+ font-medium text-primary outline-none transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70">Upgrade</a>
                </div>

                <div class="progress mt-2 h-2 bg-slate-150 dark:bg-navy-500">
                    <div class="w-7/12 rounded-full bg-info"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed, inject } from 'vue'

import { useManagerDirStore } from "@file-manager/stores/dirs"
import { useManagerFiltersStore } from '@file-manager/stores/filters'

const APIHttp = inject('APIHttp')

const expanded = ref(false)

const selectedDir = ref(useManagerDirStore().directory)

const { loadStoreDirs } = useManagerDirStore()

const { setFilters } = useManagerFiltersStore()


onMounted(async () => {

    await loadStoreDirs(APIHttp, { type: 'dir' })
})
</script>