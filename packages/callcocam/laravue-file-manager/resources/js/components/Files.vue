<template>
    <div>
        <div class="grid grid-cols-6 gap-2 p-3 h-[450px] overflow-y-auto content-start" v-infinite-scroll="[onLoadMore, { 'distance': 10 }]">
            <template v-if="files.length">
                <template v-for="(file, index) in files" :key="file.id">
                    <f-file :file="file" :context="context" @selectedFile="$emit('selectedFile', $event)"/>
                </template>
            </template>
        </div>
    </div>
</template>
<script setup>
import { onMounted, computed } from 'vue'
import { useManagerFilesStore } from '@file-manager/stores/files'
import { useManagerParamsStore } from '@file-manager/stores/params';

const props = defineProps({
    context: {
        type: Object,
        default: {}
    }
})

const file = computed(() => useManagerFilesStore().selectedFile)
const files = computed(() => useManagerFilesStore().files)
const complete = computed(() => useManagerFilesStore().complete)
const { loadStoreFiles, loadStoreMoreFiles } = useManagerFilesStore()

const onLoadMore = async () => {
    
    if(complete.value) return 

    await loadStoreMoreFiles(props.context.services, useManagerParamsStore().params)
     
}


onMounted(async () => {

    await loadStoreFiles(props.context.services, useManagerParamsStore().params)
})

</script>