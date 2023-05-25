<template>
    <ul v-if="fileUploads.length">
        <li v-for="file in fileUploads" :key="file.uuid">
            <f-uploader-file :file="file" :image-preview="imagePreview" :ref="file.uuid" />
            <div v-if="file.error" v-text="file.error" />
        </li>
    </ul>
</template>
<script setup>
import { computed } from 'vue';
import Upload from '@file-manager/upload';
const props = defineProps({
    file: {
        type: Upload
    },
    imagePreview: {
        type: [Boolean, String],
        default: false
    }
})

const fileUploads = computed(() => props.file.getFiles() || [])
</script>