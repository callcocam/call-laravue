<template>
    <div class="flex items-center justify-between">
        <div>
            <f-sidebar-links-btn-folder-delete v-if="directory.hasOwnProperty('path')" />
        </div>
        <div>
            <f-uploader-form :context="context" />
        </div>
    </div>
</template>
<script setup>
import { ref, computed } from 'vue'
import { useManagerDirStore } from '@file-manager/stores/dirs';
const props = defineProps({
    context: {
        type: Object
    }
})
const directory = computed(() => useManagerDirStore().directory)

</script>