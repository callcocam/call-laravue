<template>
    <div :data-id="setId(field.id)" :class="[('md:col-span-').concat(field.span)]"
        class="relative col-span-12 border hover:border-dashed cursor-move p-1 rounded-md group/item">
        <div class="absolute right-1 flex space-x-2">
            <button @click="setEdit(field)" type="button">
                <x-icon name="fa-edit" class="text-base w-5 h-5" />
            </button>
            <button @click="setDelete(field)" type="button">
                <x-icon name="fa-trash" class="text-base w-5 h-5" />
            </button>
        </div>
        <CFormInput :type="field.type" :label="field.label" :name="field.slug" :options="field.options" />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useManagerMakeElementStore } from '@laravue-makes/stores/element'
const props = defineProps({
    field: {
        type: [Object, Array, Boolean],
        default: false
    }
})

const setId = (id) => {
    return id
}

const setEdit = (field) => {
    useManagerMakeElementStore().setFormValue(field)
    useManagerMakeElementStore().setShowEdit(true)
}

const setDelete = (field) => {
    useManagerMakeElementStore().setFormValue(field)
    useManagerMakeElementStore().setShowDelete(true)
}
</script>