<template>
    <div class="fm-sidebar-panel-min">
        <div class="flex h-full flex-col items-center bg-white dark:bg-navy-750">
            <div class="flex h-18 shrink-0 items-center justify-center">
                <div
                    class="avatar flex h-10 w-10 rounded-full bg-primary/10 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                    <div class="is-initial">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            xmlns="http://www.w3.org/2000/svg" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex h-[calc(100%-4.5rem)] grow flex-col">
                <div class="is-scrollbar-hidden flex grow flex-col overflow-y-auto">
                    <ul class="mt-4 space-y-1">
                        <li>
                            <a href="#"
                                class="btn h-10 w-10 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="btn h-10 w-10 p-0 text-warning hover:bg-warning/20 focus:bg-warning/20 active:bg-warning/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <template v-if="filters" v-for="(filter, index) in filters" :key="index">
                        <ul class="space-y-1">
                            <li v-for="({ label, val, color, icon }, path) in filter" :key="path">
                                <button type="button" :title="label" @click="loadFilter({ val, path })"
                                    class="btn h-10 w-10 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <f-icons-icon :name="icon" class="h-5.5 w-5.5"
                                        :class="{ 'text-cyan-800 dark:text-cyan-500': hasParam(path) }" />
                                </button>
                            </li>
                        </ul>
                        <div class="my-4 h-px bg-slate-200 dark:bg-navy-500"></div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, defineEmits } from 'vue'
import { useManagerFiltersStore } from '@file-manager/stores/filters'
import { useManagerParamsStore } from '@file-manager/stores/params'

const emit = defineEmits(['onLoadFiles'])

const filters = computed(() => useManagerFiltersStore().filters)

const { setParams, hasParam, resetParam } = useManagerParamsStore()

const loadFilter = async ({ val, path }) => {
    if (hasParam(path)) {
        resetParam(path)
        emit('onLoadFiles', {})
    } else {
        setParams({ [path]: val })
        emit('onLoadFiles', { [path]:val })
    }
}
</script>