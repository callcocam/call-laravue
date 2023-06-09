<template>
    <div class="relative col-span-12  border hover:border-dashed p-1 rounded-md group/item" :data-id="setId(field.id)"
        :class="[('md:col-span-').concat(field.span)]">
        <div class="absolute right-0 flex space-x-2 top-0 z-[200]  p-1 group/edit invisible group-hover/item:visible">
            <button @click="setEdit(field)" type="button">
                <x-icon name="fa-edit" class="text-base w-5 h-5" />
            </button>
            <button @click="setDelete(field)" type="button">
                <x-icon name="fa-trash" class="text-base w-5 h-5" />
            </button>
            <span class="board-cards-handler cursor-move ">
                <x-icon name="fa-expand-arrows-alt" class="text-base w-5 h-5" />
            </span>
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