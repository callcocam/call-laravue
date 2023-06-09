<template>
    <div 
    :class="[('md:col-span-').concat(board.span)]"
        class=" card col-span-12 p-4 rounded-lg board-draggable relative flex max-h-full shrink-0 flex-col w-full">
        <div class="board-draggable-handler flex relative items-center justify-between w-full pb-3 cursor-move">
            <div class="flex items-center space-x-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-info/10 text-info">
                    <x-icon :name="board.icon" class="text-base w-5 h-5" />
                </div>
                <h3 class="text-base text-slate-700 dark:text-navy-100">
                    {{ board.name }}
                </h3>
            </div>
            <div class="flex space-x-1 items-center absolute right-4">
                <EditBoard :board="board" @loadBoards="$emit('loadBoards', $event)" />
                <DeleteBoard :board="board" @loadBoards="$emit('loadBoards', $event)" />
            </div>
        </div>
        <Draggable  :board-id="board.id">
            <Element v-for="(field, index) in elements" :key="field.id" :field="field" :field-id="field.id"
                @loadBoards="$emit('loadBoards', true)" />
        </Draggable>
        <div class="flex justify-center py-2">
            <AddElement @add="addField" />
        </div>
    </div>
</template>
<script setup>
import ErrorService from "@/services/ErrorService";
import { inject, ref } from 'vue';
import Element from './Element.vue'
import AddElement from './AddElement.vue'
import EditBoard from './EditBoard.vue';
import DeleteBoard from './DeleteBoard.vue';
import { find, get, map } from 'lodash';
import Draggable from "./Draggable.vue";

const MAKEAPP = inject('MAKE')

const props = defineProps({
    board: {
        type: [Object, Array, Boolean],
        required: true
    },
    fields: {
        type: [Object, Array, Boolean],
        default: false
    }
})

const elements = ref(props.board.items)

const addField = async (field) => {
    console.log(field)
    if (field) {
        const formData = new FormData()
        map(field, (item, name) => {
            if (!name.includes('options')) {
                formData.append(name, item)
            } else {
                formData.append(name, JSON.stringify(item))
            }
        })
        formData.append('label', field.name)
        formData.append('make_board_id', props.board.id)
        formData.append('status', 'published')
        try {
            const { data } = await MAKEAPP.post('make/board/items', formData)
            const { message, form_data } = data
            if (message) {
                ErrorService.displaySuccessAlert(message);
            }
            if (form_data) {
                elements.value.push(form_data)
            }
        } catch (error) {
            ErrorService.displayErrorAlert(error);
        }
    }
    //make/board/items
}
</script>