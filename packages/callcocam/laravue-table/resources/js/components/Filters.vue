<template>
    <div>
        <div class="flex items-center justify-between">
            <h2 class="text-base  font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                <span v-if="label"> {{ label }}</span>
            </h2>
            <div class="flex items-center space-x-2">
                <div class="flex gap-1 mt-4 flex-wrap mx-5" v-if="getFilters().length">
                    <button class="badge space-x-1 rounded-full bg-info/10 text-info dark:bg-info/15"
                        v-for="(filter, key) in getFilters()" @click="removeFilter(filter)" :key="key">
                        <span>{{ filter }}</span>
                        <x-icon name="fa-times-circle" class="w-4 h-4 text-red-400" />
                    </button>
                    <button @click="clearFilters" class="badge space-x-1 rounded-full bg-info/10 text-info dark:bg-info/15">
                        <span>{{ $t('Remoe all') }}</span>
                        <x-icon name="fa-times-circle" class="w-4 h-4 text-red-400" />
                    </button>
                </div>
                <TRange  />
                <div class="flex items-center relative">
                    <label for="end" class="block">
                        <span>Buscar</span>
                        <div class="relative mt-1.5">
                            <TSearch type="text" class="pl-9" placeholder="Bscar..." />
                            <span class="absolute h-8 w-8 left-3 top-2.5">
                                <x-icon name="fa-search" class="h-5 w-5" />
                            </span>
                        </div>
                    </label>

                </div>
            </div>
        </div>
        <slot />
    </div>
</template>
<script setup>
import { filter, keys } from 'lodash';
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router'
const route = useRoute()
const router = useRouter()
const props = defineProps({
    label: {
        type: [Boolean, String],
        default: false
    }
})

const removeFilter = (key) => {
    const query = { ...route.query }
    delete query[key]
    console.log(key, query)
    router.push({ name: route.name, query })
}

const clearFilters = () => {
    router.push({ name: route.name })
}

const getFilters = () => {
    return filter(keys(route.query), (f, key) => key != 'page')
}
</script>