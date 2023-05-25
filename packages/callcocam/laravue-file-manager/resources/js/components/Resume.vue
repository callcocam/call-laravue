<template>
    <div class="px-4 absolute bottom-0 right-0 left-0 flex flex-col bg-slate-800">
        <div class="flex flex-col">
            <f-filters :context="context"
                v-if="Object.keys(params).filter(v => !v.includes('page') && !v.includes('type'))" />
            <div v-if="selectedCount">
                <span>{{ $t('You have selected') }} <strong>{{ selectedCount }}</strong>
                    {{ $t('transactions, do you want to select all') }}
                    <strong>{{ filesCount }}</strong>?
                </span>
            </div>
            <div class="text-xs+">
                {{ $t('Showing') }}
                <span class="font-medium">{{ obj.from }}</span>
                {{ $t('to') }}
                <span class="font-medium">{{ obj.to }}</span>
                {{ $t('of') }}
                <span class="font-medium">{{ obj.total }}</span>
                {{ $t('results') }}
            </div>
        </div>
        <div class="flex items-center space-x-4 py-1 justify-between">
            <template v-if="!selectedCountFiles">
                <button @click="selectAll"
                    class="ml-1 flex items-center dark:text-blue-200 text-blue-900 font-bold space-x-1">
                    <f-icons-icon name="fa-eye" class="h-4 w-4" /> <span>{{ $t('Select All') }}</span>
                    <span v-if="selectedCountFiles">Deselect All</span>
                </button>
            </template>
            <template v-if="selectedCountFiles">
                <button @click="DeselectAll"
                    class="ml-1 flex items-center dark:text-green-200 text-green-900 font-bold space-x-1">
                    <f-icons-icon name="fa-eye-slash" class="h-4 w-4" /> <span>{{ $t('Deselect All')
                    }}</span>
                </button>
            </template>
            <template v-if="selectedCount">
                <template v-if="params.hasOwnProperty('trashed')">
                    <button @click="() => removeSelectAll(params)"
                        class="ml-1 dark:text-red-200 text-red-600 font-bold flex items-center space-x-1">
                        <f-icons-icon name="fa-regular-trash-alt" class="h-4 w-4" />
                        <span>{{ $t('Permanently remove files selected') }}</span>
                    </button>
                </template>
                <template v-else>
                    <button @click="() => removeSelectAll(params)"
                        class="ml-1 dark:text-red-200 text-red-600 font-bold flex items-center space-x-1">
                        <f-icons-icon name="fa-regular-trash-alt" class="h-4 w-4" />
                        <span>{{ $t('Remove files selected') }}</span>
                    </button>
                </template>
            </template>
        </div>
        <!-- <x-laravue-file-manager-progress /> -->
        <div class="flex border-t py-2 items-center">
            <div class="flex-1">
                <f-footer :context="context"/>
            </div>

        </div>
    </div>
</template>
<script setup>
import { reactive, computed, inject } from 'vue'
import { useManagerFilesStore } from '@file-manager/stores/files'
import { useManagerParamsStore } from '@file-manager/stores/params';
import { useManagerSelectedStore } from '@file-manager/stores/selected';
const props = defineProps({
    context: {
        type: Object,
        default: {}
    }
})
const { context } = props

const APIHttp = inject('APIHttp')

const sel = useManagerSelectedStore()
const obj = computed(() => useManagerFilesStore().obj)
const params = computed(() => useManagerParamsStore().params)
const files = computed(() => useManagerFilesStore().files)
const selectedCount = computed(() => sel.selected.length)
const selectedCountFiles = computed(() => files.value.length && sel.selected.length >= files.value.length)
const filesCount = computed(() => files.value.length)
const { setLoading } = useManagerFilesStore()
const selectAll = () => {
    files.value.map(item => {
        if (sel.selected.findIndex(v => v === item.id) < 0) {
            sel.selectedFiles(item.id)
        }
    })
}

const DeselectAll = () => {
    files.value.map(item => {
        if (sel.selected.findIndex(v => v === item.id) >= 0) {
            if (selectedCountFiles) {
                sel.selected.splice(sel.selected.findIndex(v => v === item.id), 1);
            }
        }
    })
}

const removeSelectAll = (params = {}) => {
    sel.selected.map(item => {
        const file = files.value.find(v => v.id === item);
        if (file) {
            setLoading(true)
            try {
                if (file.type == 'dir') {
                    APIHttp.deleteServiceFolder(item, params).then(resp => {
                        sel.selected.splice(sel.selected.findIndex(v => v === item), 1);
                        files.value.splice(files.value.findIndex(v => v.id === file.id), 1);
                        setLoading(false)
                    })
                }
                else {
                    APIHttp.removeServiceFile(item, params).then(resp => {
                        sel.selected.splice(sel.selected.findIndex(v => v === item), 1);
                        files.value.splice(files.value.findIndex(v => v.id === file.id), 1);
                        setLoading(false)
                    })
                }
            } catch (e) {
                setLoading(false)
                console.log(e)
            }
        }
    })
}
</script>