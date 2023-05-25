<template>
    <div class="flex flex-col items-center mb-4 border-b border-dashed space-y-1 pb-1">
        <div class="flex w-full justify-between items-center">
            <div v-if="!!(imagePreview && file.previewData)">
                <img :src="file.previewData">
            </div>
            <div class="truncate" :title="file.name" v-text="file.name" />

            <div class="flex items-center space-x-3" v-if="newFile">
                <button type="button" @click="file.selectFile(newFile)">
                    <f-icons-icon name="fa-check" class="h-6 w-6" />
                </button>
                <button type="button" @click="download(newFile)">
                    <f-icons-icon name="fa-cloud-download-alt" class="h-6 w-6" />
                </button>
                <a target="_blank" :href="newFile.link_url">
                    <f-icons-icon name="fa-eye" class="h-6 w-6" />
                </a>
                <button type="button" @click="file.removeFile(file)">
                    <f-icons-icon name="fa-regular-trash-alt" class="h-6 w-6" />
                </button>
            </div>
        </div>
        <div class="progress mb-2 h-2 bg-slate-150 dark:bg-navy-500" v-if="file.progress">
            <div class="rounded-full bg-info" :style="{ width: file.progress + '%' }" />
        </div>
    </div>
</template>
<script setup>
import { ref, computed, inject, onMounted, onUnmounted } from 'vue'
import { downloadFile } from '@file-manager/helpers';
const props = defineProps({
    imagePreview: {
        type: Boolean,
    },
    file: {
        type: Object
    }
})

const newFile = ref(null)

const download = ({ url, name }) => downloadFile(url, name)


const APIHttp = inject('APIHttp')

const submitFile = (file) => {
    if (file.hasOwnProperty('file') && file.file) {
        /*
          Initialize the form data
        */
        let formData = new FormData();

        /*
          Add the form data we need to submit
        */
        formData.append('file', file.file);

        if (file.hasOwnProperty('directory') && file.directory) {

            if (file.directory.hasOwnProperty('id')) {
                formData.append('file_manager_id', file.directory.id)
            }
            if (file.directory.hasOwnProperty('path')) {
                formData.append('path', file.directory.path)
            }
        }
        /*
          Make the request to the POST /single-file URL
        */
        APIHttp.uploadServiceFile(formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: (progressEvent) => {
                    file.progress = parseInt(Math.round((progressEvent.loaded / progressEvent.total) * 100));
                }
            }
        ).then(resp => resp.data).then(function (data) {
            newFile.value = data.file
            file.complete = true;
            file.progress = 0;
            file.id = data.file.id;
            file.loadFiles(file);
            file.file = null;
        })
            .catch(function (e) {
                file.complete = true;
            });
    }
}

onMounted(() => {
    submitFile(props.file)
})

onUnmounted(() => {
    // props.file = null
})

</script>