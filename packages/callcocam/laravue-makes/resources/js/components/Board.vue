<template>
    <div :class="[('md:col-span-').concat(board.span)]"
        class="col-span-12 border border-dotted p-2 rounded-lg board-draggable relative flex max-h-full shrink-0 flex-col w-full">
        <div class="board-draggable-handler flex items-center justify-between w-full pb-3">
            <div class="flex items-center space-x-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-info/10 text-info">
                    <x-icon :name="board.icon" class="text-base w-5 h-5" />
                </div>
                <h3 class="text-base text-slate-700 dark:text-navy-100">
                    {{ board.name }}
                </h3>
            </div>
            <div class="flex space-x-1 items-center">
                <EditBoard :board="board" @loadBoards="$emit('loadBoards', $event)" />
                <DeleteBoard :board="board" @loadBoards="$emit('loadBoards', $event)" />
            </div>
        </div>
        <div v-draggable="{
            animation: 200,
            group: 'board-cards',
            easing: 'cubic-bezier(0, 0, 0.2, 1)',
            direction: 'vertical',
            delay: 150,
            delayOnTouchOnly: true,
        }" class="is-scrollbar-hidden relative space-y-2.5 overflow-y-auto p-0.5">
            <Element v-for="(field, index) in elements" :key="index" :field="field" @loadBoards="$emit('loadBoards', true)"/>
        </div>
        <div class="flex justify-center py-2">
            <AddElement :fields="fields" @add="addField" />
        </div>
    </div>
</template>
<script setup>
import ErrorService from "@/services/ErrorService";
import { inject, ref, defineEmits } from 'vue';
import Element from './Element.vue'
import AddElement from './AddElement.vue'
import EditBoard from './EditBoard.vue';
import DeleteBoard from './DeleteBoard.vue';
import { find, get, map } from 'lodash';

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

const addField = async (id) => {
    const field = find(props.fields, (item) => item.id == id)
    if (field) {
        const formData = new FormData()
        map(field, (item, name) => {
            if (!name.includes('options')) {
                formData.append(name, item)
            }else{
                
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