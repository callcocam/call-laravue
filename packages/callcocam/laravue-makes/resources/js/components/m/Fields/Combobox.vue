<template>
    <Combobox v-model="selectedItem">
        <div class="relative mt-1">
            <div class="relative">
                <ComboboxInput
                    class="mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                    @change="query = $event.target.value" :displayValue="(option) => option.name" />
                <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                </ComboboxButton>
            </div>
            <ComboboxOptions
                class="absolute left-0 right-0 z-50 p-3 rounded-md border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                <template v-for="(option, index) in filteredItems" :key="index">
                    <template v-if="option.hasOwnProperty('value')">
                        <ComboboxOption :value="option.value">{{ option.label }}</ComboboxOption>
                    </template>
                    <template v-else>
                        <ComboboxOption :value="index">{{ option }}</ComboboxOption>
                    </template>
                </template>
            </ComboboxOptions>
        </div>
    </Combobox>
</template>

<script setup>
import { ref, computed } from 'vue'
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
    options: {
        type: [Boolean, Object, Array],
        default: false
    }
})
const people = [
    { id: 1, name: 'Durward Reynolds' },
    { id: 2, name: 'Kenton Towne' },
    { id: 3, name: 'Therese Wunsch' },
    { id: 4, name: 'Benedict Kessler' },
    { id: 5, name: 'Katelyn Rohan' },
]
const selectedItem = ref([])
const query = ref('')

const filteredItems = computed(() =>
    query.value === ''
        ? props.options
        : props.options.filter((option) => {
            return option.name.toLowerCase().includes(query.value.toLowerCase())
        })
)
</script>