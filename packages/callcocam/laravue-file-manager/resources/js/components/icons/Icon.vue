<template>
    <v-icon :name="icon" :scale="scale"  />
</template>
<script setup>
const props = defineProps({
    icon: {
        type: String,
        default: 'fa-arrow-alt-circle-up'
    },
    scale: {
        type: [String, Number],
        default: 2
    }
})
</script>