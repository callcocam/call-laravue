<template>
    <div :class="{ 'border-2 border-dashed border-sky-500  dark:bg-green-300/20': isSelected(selectedFile, file) }"
        class="rounded col-span-3 md:col-span-2 flex  flex-col z-0 items-center bg-slate-100 dark:bg-slate-800 hover:bg-slate-300/20 dark:hover:bg-navy-300/20 relative">
        <template v-if="['png', 'jpg', 'gif'].includes(file.extension)">
            <div class="avatar h-24 w-24 flex items-center justify-center" v-tooltip.placement.top="file.id">
                <button @click="selectFile(file)">
                    <img class="mask is-squircle" :src="file.link_url" :alt="file.name" />
                </button>
            </div>
        </template>
        <template v-if="['pdf'].includes(file.extension)">
            <div class="avatar h-24 w-24 flex items-center justify-center">
                <a target="_blank" :href="file.link_url">
                    <v-icon name="fa-file-pdf" flip="vertical" scale="4" />
                </a>
            </div>
        </template>
        <template v-if="['mp4'].includes(file.extension)">
            <div class="avatar h-24 w-24 flex items-center justify-center">
                <a target="_blank" :href="file.link_url">
                    <v-icon name="fa-play-circle" flip="vertical" scale="4" /></a>
            </div>
        </template>
        <template v-if="['mp3'].includes(file.extension)">
            <div class="avatar h-24 w-24 flex items-center justify-center">
                <a target="_blank" :href="file.link_url">
                    <v-icon name="fa-itunes-note" flip="vertical" scale="4" /></a>
            </div>
        </template>
        <f-selected :file="file" v-if="!isSelected(selectedFile, file)">
            <label class="inline-flex items-center absolute top-1 right-1">
                <input :value="file.id" v-model="sel.selected"
                    class="form-switch h-3.5 w-7 rounded-full bg-slate-300 before:rounded-full before:bg-slate-50 checked:bg-primary checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-accent dark:checked:before:bg-white"
                    type="checkbox" />
            </label>
        </f-selected>
        <f-actions :file="file" :context="context" />
    </div>
</template>
<script setup>
import { computed, inject } from 'vue';
import { useManagerSelectedStore } from '@file-manager/stores/selected';
import { useManagerFilesStore } from '@file-manager/stores/files';

const emit = defineEmits(['close', 'selectedFile'])
const APIHttp = inject('APIHttp')

const selectedFile = computed(() => useManagerFilesStore().selectedFile)

const props = defineProps({
    file: { type: Object },
    context: {
        type: Object,
        default: {}
    }
})

const { setFile } = useManagerFilesStore()
const sel = useManagerSelectedStore()

const isSelected = (s, f) => {
    return s.id == f.id
}

const selectFile = async (file) => {
    setFile(file)
    emit('selectedFile', file)
    emit('close', false)
    const formData = new FormData();
    formData.append('id', file.id)
    formData.append('recent', moment().format('YYYY-MM-DD h:mm:ss'))
    formData.append('updated_at', moment().format('YYYY-MM-DD h:mm:ss'))
    await APIHttp.uploadServiceFilter(formData)

}

</script>