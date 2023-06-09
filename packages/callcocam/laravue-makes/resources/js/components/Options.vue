<template>
    <div v-if="options">
        <div class="flex items-center">
            <div class="my-2 mx-4 h-px shrink-0 bg-slate-200 dark:bg-navy-500 flex-1"></div>
            <span class="text-base font-medium text-slate-700 dark:text-navy-100">FONTE</span>
            <div class="my-2 mx-4 h-px shrink-0 bg-slate-200 dark:bg-navy-500 flex-1"></div>
        </div>
        <div class="flex flex-col space-x-2">
            <div class="grid grid-cols-3 gap-x-2">
                <label class="block">
                    <span>Ordering</span>
                </label> 
                 <label class="block">
                    <span>Label</span>
                </label>
                <label class="block">
                    <span>Valor</span>
                </label>
            </div>
            <div class="flex" v-for="option in valueOptions" :key="option.id" :data-id="option.id">
                <EditOption :option="option" @loadOptions="removeOptions" />
            </div>
            <AddOption :field="field" @loadOptions="loadOptions" />
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import AddOption from './AddOption.vue';
import EditOption from './EditOption.vue';

const props = defineProps({
    options: {
        type: [Boolean, Array, Object],
        default: false
    },
    field: {
        type: [Boolean, Array, Object],
        default: false
    }
})
const valueOptions = ref(props.options)

const loadOptions = (data) => {
    valueOptions.value.push(data)
}

const removeOptions = (id) => {
    valueOptions.value = valueOptions.value.filter(function (item) { 
        return item.id !== id
    })
}

</script>