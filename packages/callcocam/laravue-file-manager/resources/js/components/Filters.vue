<template>
    <div class="flex space-x-2 p-3">
        <template v-for="(items, index) in filters" :key="index">
            <template v-for="(item, path) in items" :key="path">
                <template v-if="hasParam(path)">
                    <div class="badge rounded-full" :class="{
                        'bg-secondary dark:bg-accent text-white': item.color == 'prmary',
                        'bg-info text-white': item.color == 'info',
                        'bg-success text-white': item.color == 'success',
                        'bg-warning text-white': item.color == 'warning',
                        'bg-error text-white': item.color == 'error',
                    }">
                        {{ item.label }}
                        <button class="ml-2" type="button" @click="onClick(path)">
                            <f-icons-icon name="fa-regular-times-circle" class="h-4 w-4" />
                        </button>
                    </div>
                </template>
            </template>
        </template>
    </div>
</template>
<script setup>
import { computed } from 'vue'
import { useManagerFilesStore } from '@file-manager/stores/files'
import { useManagerFiltersStore } from '@file-manager/stores/filters'
import { useManagerParamsStore } from '@file-manager/stores/params';

const filters = computed(() => useManagerFiltersStore().filters)
const { loadStoreFiles } = useManagerFilesStore()
const { hasParam, resetParam } = useManagerParamsStore()

const props = defineProps({
    context: {
        type: Object,
        default: {}
    }
})
const { context } = props
const onClick = async (path) => {
    resetParam(path)
    await loadStoreFiles(context.services, useManagerParamsStore().params)
}

</script>