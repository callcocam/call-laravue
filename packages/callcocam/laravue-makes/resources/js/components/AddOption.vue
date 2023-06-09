<template>
    <div class="grid grid-cols-1 mt-4">
        <button @click="addOption(form)" type="button"
            class="flex items-center justify-center space-x-2 font-medium text-slate-600 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
            <x-icon name="fa-plus" class="h-6 w-6" />
            <span>{{ $t('New Option') }}</span>
        </button>
    </div>
</template>
<script setup>
import { inject, ref, defineEmits } from 'vue';


const MAKEAPP = inject('MAKE')

const emit = defineEmits(['loadOptions'])

const props = defineProps({
    field: {
        type: [Object],
        required: true
    }
})

const form = ref({
    value: 'one',
    label: 'ONE',
})
const addOption = async (form) => {
    
    const formData = new FormData()
    formData.append('make_board_item_id', props.field.id)
    formData.append('name', form.value)
    formData.append('description', form.label)
    formData.append('status', 'published')

    try {
        const { data } = await MAKEAPP.post('make/board/item/options', formData) 

        const { form_data } = data

        emit('loadOptions', {
            id: form_data.id,
            value: form_data.name,
            label: form_data.description,
        })
    } catch (error) {
        ErrorService.displayErrorAlert(error);
    }

} 
</script>