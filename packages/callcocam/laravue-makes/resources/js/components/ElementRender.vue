<template></template>

<script setup>

const props = defineProps(
    {
        eleName: String,
        formItem: Object,
        validator(value) {
            return true;
        },
        __ID: String,
        tag: String,
        attrs: Object,
        events: {
            type: Object,
            default: {},
        },
        slots: Object,
        ctrlBtn: Boolean,
        currentID: String,

        childrens: Array,
        defaultvalue: {
            default: undefined,
        },
    }
)
</script>