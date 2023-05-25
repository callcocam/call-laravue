<template>
    <div v-if="filters" v-for="(filter, index) in filters" :key="index">
        <ul class="space-y-1.5 px-2 font-inter text-xs+ font-medium">
            <li v-for="({ label, val, color, icon }, path) in filter" :key="path">
                <button type="button" @click="loadFilter({ val, path })"
                    class="group w-full flex space-x-2 rounded-lg p-2 tracking-wide text-slate-800 outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
                    href="#">
                    <f-icons-icon :name="icon"
                        class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200" />
                    <span :class="{ 'text-cyan-800 dark:text-cyan-500': hasParam(path) }"
                        class="text-slate-800 dark:text-navy-100">{{ label }}</span>
                </button>
            </li>

        </ul>
        <div class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>
    </div>
</template>
<script setup>

import { computed, defineEmits } from 'vue'

import { useManagerFiltersStore } from '@file-manager/stores/filters'

import { useManagerParamsStore } from '@file-manager/stores/params'

const emit = defineEmits(['onLoadFiles'])

const { setParams, hasParam, resetParam } = useManagerParamsStore()

const filters = computed(() => useManagerFiltersStore().filters)

const loadFilter = async ({ val, path }) => {
    if (hasParam(path)) {
        resetParam(path)
        emit('onLoadFiles', {})
    } else {
        setParams({ [path]: val })
        emit('onLoadFiles', { [path]: val })
    }
}

</script>