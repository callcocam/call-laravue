<template>
    <div class="flex items-center space-x-0">
        <template v-if="deleted_at">
            <f-icons-flat-icon v-if="isFile(type)" v-tooltip.placement.top="$t('Bownload file')"
                @click="() => download(url, name)">
                <f-icons-icon class="h-4.5 w-4.5 text-slate-400 transition-colors" name="fa-download" />
            </f-icons-flat-icon>
            <f-icons-flat-icon v-tooltip.placement.top="$t(('Restore ').concat(type))"
                @click="() => removeRestore(id, { restore: 1 }, type)">
                <f-icons-icon class="h-4.5 w-4.5 text-slate-400 transition-colors" name="fa-trash-restore" />
            </f-icons-flat-icon>
            <f-icons-flat-icon v-tooltip.placement.top="$t(('Permanently remove ').concat(type))"
                @click="() => removeRestore(id, { trashed: 1 }, type)">
                <f-icons-icon class="h-4.5 w-4.5 text-slate-400 transition-colors" name="fa-trash-alt" />
            </f-icons-flat-icon>
        </template>
        <template v-else>
            <f-icons-flat-icon v-if="isFile(type)" v-tooltip.placement.top="$t('Bownload file')"
                @click="() => download(url, name)">
                <f-icons-icon class="h-4.5 w-4.5 text-slate-400 transition-colors" name="fa-download" />
            </f-icons-flat-icon>
            <f-icons-flat-icon v-tooltip.placement.top="$t('Mark as important file')"
                @click="() => updatedFile(id, 'important', important ? 0 : 1)">
                <f-icons-icon class="h-4.5 w-4.5 text-slate-400 transition-colors" name="fa-regular-star" :class="{
                    'group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200': !important,
                    'group-hover:text-yellow-500 group-focus:text-yellow-500 dark:text-yellow-300 dark:group-hover:text-yellow-200 dark:group-focus:text-yellow-200': important,
                }" />
            </f-icons-flat-icon>
            <f-icons-flat-icon v-tooltip.placement.top="$t('Mark as shared file')"
                @click="() => updatedFile(id, 'shared', shared ? 0 : 1)">
                <f-icons-icon class="h-4.5 w-4.5 text-slate-400 transition-colors" name="fa-share-alt" :class="{
                    'group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200': !shared,
                    'group-hover:text-yellow-500 group-focus:text-yellow-500 dark:text-yellow-300 dark:group-hover:text-yellow-200 dark:group-focus:text-yellow-200': shared,
                }" />
            </f-icons-flat-icon>
            <f-icons-flat-icon v-tooltip.placement.top="$t('Mark as recent file')"
                @click="() => updatedFile(id, 'recent', moment().format('YYYY-MM-DD h:mm:ss'))">
                <f-icons-icon class="h-4.5 w-4.5 text-slate-400 transition-colors" name="fa-regular-clock" />
            </f-icons-flat-icon>
            <!-- <f-files-rename :file="file" /> -->
        </template>
    </div>
</template>
<script setup>
import { ref, computed , inject} from 'vue';
import moment from 'moment';
import { useManagerFilesStore } from '@file-manager/stores/files'
import { useManagerDirStore } from '@file-manager/stores/dirs';
import { useManagerParamsStore } from '@file-manager/stores/params';
import { downloadFile } from '@file-manager/helpers';


const APIHttp = inject('APIHttp')

const params = computed(() => useManagerFilesStore().params)

const { setParams } = useManagerParamsStore()
const { setFiles, loadStoreFiles, setLoading } = useManagerFilesStore()
const { loadStoreDirs } = useManagerDirStore()

const props = defineProps({
    file: {
        type: Object
    },
    context: {
        type: Object,
        default: {}
    }
})
const { context } = props

const { name, url, id, state, shared, important, deleted_at, type, driver_id } = props.file


const download = (url, filename) => downloadFile(url, filename)

const isFile = (type) => type == 'file'

const updatedFile = async (id, field, value) => {
    setLoading(true)
    try {
        const formData = new FormData();
        formData.append('id', id)
        formData.append(field, value)
        formData.append('recent', moment().format('YYYY-MM-DD h:mm:ss'))
        formData.append('updated_at', moment().format('YYYY-MM-DD h:mm:ss'))

        await APIHttp.uploadServiceFilter(formData)

        await loadStoreFiles(APIHttp, params.value)

        setLoading(false)
    } catch (e) {
        setLoading(false)
        console.log(e)
    }
}


const removeRestore = async (id, params, type) => {
    setParams({ type: 'file', 'trashed': 1, driver_id })
    if (type == 'dir') return removeRestoreFolder(id, params)
    if (type == 'file') return removeRestoreFile(id, params)
}

const removeRestoreFile = async (id, params) => {
    setLoading(true)
    try {
        await APIHttp.removeServiceFile(id, params)
        await loadStoreFiles(APIHttp)
    } catch (e) {
        setLoading(false)
    }
}


const removeRestoreFolder = async (id, params) => {
    setLoading(true)
    try {
        await APIHttp.deleteServiceFolder(id, params)
        await loadStoreDirs(APIHttp)
        await loadStoreFiles(APIHttp)
    } catch (e) {
        setLoading(false)
    }
}

</script>