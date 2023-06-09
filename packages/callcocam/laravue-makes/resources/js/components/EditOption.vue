<template>
    <div class="grid grid-cols-3 gap-x-2 relative " :data-id="form.id">
        <input v-model="form.ordering" @change="updateIn(form)"
            class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-1 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
            placeholder="0" type="number" />
        <input v-model="form.label" @change="updateIn(form)"
            class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-1 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
            placeholder="Label" type="text" />
        <input v-model="form.value" @change="updateIn(form)"
            class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-1 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
            placeholder="Valor" type="text" />
        <button @click="deleteOption(form.id)" type="button" class="absolute right-1 top-2">
            <x-icon name="fa-trash" class="w-4 h-4" />
        </button>
    </div>
</template>
<script setup>
import { inject, ref, defineEmits } from 'vue';

const emit = defineEmits(['loadOptions'])

const MAKEAPP = inject('MAKE')

const props = defineProps({
    option: {
        type: [Object],
        default: {
            id: '',
            value: '',
            label: '',
            ordering: '',
        }
    }
})
const form = ref(props.option)

const updateIn = async (form) => {
    const formData = new FormData()
    formData.append('name', form.value)
    formData.append('description', form.label)
    formData.append('ordering', form.ordering)
    try {
        const { data } = await MAKEAPP.put(('make/board/item/options/').concat(form.id), formData)
    } catch (error) {
        ErrorService.displayErrorAlert(error);
    }
}

const deleteOption = async (id) => {
    try {
        const { data } = await MAKEAPP.delete(('make/board/item/options/').concat(id))
        emit('loadOptions', id)
    } catch (error) {
        ErrorService.displayErrorAlert(error);
    }
}
</script>