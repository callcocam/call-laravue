<template>
    <div :class="{
        'md:col-span-1': span.toString() === '1',
        'md:col-span-2': span.toString() === '2',
        'md:col-span-3': span.toString() === '3',
        'md:col-span-4': span.toString() === '4',
        'md:col-span-5': span.toString() === '5',
        'md:col-span-6': span.toString() === '6',
        'md:col-span-7': span.toString() === '7',
        'md:col-span-8': span.toString() === '8',
        'md:col-span-9': span.toString() === '9',
        'md:col-span-10': span.toString() === '10',
        'md:col-span-11': span.toString() === '11',
    }" class="col-span-12 board-draggable relative flex max-h-full shrink-0 flex-col w-full">
        <div class="board-draggable-handler flex items-center justify-between   pb-3">
            <div class="flex items-center space-x-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-info/10 text-info">
                    <x-icon :name="icon" class="text-base w-5 h-5" />
                </div>
                <h3 class="text-base text-slate-700 dark:text-navy-100">
                    {{ title }}
                </h3>
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
            <Element v-for="(field, index) in elements" :key="index" :field="field" />
        </div>
        <div class="flex justify-center py-2">
            <AddElement :fields="fields" @add="addField" />
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import Element from './Element.vue'
import AddElement from './AddElement.vue'
import { find, get } from 'lodash';

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        default: 'fa-spinner'
    },
    span: {
        type: [String, Number],
        default: '12'
    },
    fields: {
        type: [Object, Array, Boolean],
        default: false
    }
})

const elements = ref([])

const addField = (id) => {
    const field = find(props.fields, (item) => item.id == id)
    if (field) {
        elements.value.push(field)
    }
}
</script>