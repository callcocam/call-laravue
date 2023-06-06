<template>
    <div :data-id="setId(field.id)" :class="[('md:col-span-').concat(field.span)]"
        class="relative col-span-12 border hover:border-dashed cursor-pointer p-1 rounded-md group/item">
        <CFormInput :type="field.type" :label="field.name" :name="field.slug" :options="field.options" />
    </div>
</template>

<script setup>
const props = defineProps({
    field: {
        type: [Object, Array, Boolean],
        default: false
    }
})
const setId = (id) => {
    return id
}
</script>