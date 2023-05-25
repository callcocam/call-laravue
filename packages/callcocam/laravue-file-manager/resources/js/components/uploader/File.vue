<template>
    <div class="flex flex-col items-center mb-4 border-b border-dashed space-y-1 pb-1">
        <div class="flex w-full justify-between items-center">
            <div v-if="!!(imagePreview && file.previewData)">
                <img :src="file.previewData">
            </div>
            <div class="truncate" :title="file.name" v-text="file.name" />

            <button type="button" v-if="(file.complete && !file.justFinished) || file.progress === false"
                @click="file.removeFile">
                X
            </button>
        </div>
        <div class="progress mb-2 h-2 bg-slate-150 dark:bg-navy-500"  v-if="file.progress">
            <div class="rounded-full bg-info" :style="{ width: file.progress + '%' }" />
        </div>
    </div>
</template>
  
<script>
export default {
    props: {
        file: {
            type: Object,
            required: true
        },
        imagePreview: {
            type: Boolean,
            default: false
        }
    }
}
</script>
  