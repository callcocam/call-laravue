<template>
    <Combobox v-model="selectedItem">
        <div class="relative flex-1">
            <div class="relative flex items-center">
                <span class="absolute top-[30%] left-2"  >
                    <x-icon :name="selectedItem || 'fa-check'" class="w-5 h-5" />
                </span>
                <ComboboxInput placeholder="Selcione um icone"
                    class="mt-1.5 pl-9 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                    :displayValue="(option) => displayValue(option)" @change="query = $event.target.value" />
                <ComboboxButton class="absolute inset-y-0 right-0  pr-2">
                    <ChevronUpDownIcon class="h-6 w-6 text-gray-400" aria-hidden="true" />
                </ComboboxButton>
            </div>
            <ComboboxOptions v-if="filteredItems.length"
                class="absolute left-0 right-0 z-50 p-3 max-h-60 overflow-y-auto rounded-md border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                <ComboboxOption v-for="(item, index) in filteredItems" :key="index" :value="item.name" as="template"
                    v-slot="{ selected, active }">
                    <div :class="{
                        'bg-slate-600 text-white': active,
                    }" class="flex items-center justify-between py-1 hover:bg-slate-300 dark:hover:text-slate-800">
                        <div class="flex items-center  space-x-2">
                            <x-icon :name="item.name" scale="2" class="w-5 h-5" />
                            <span>{{ item.name }}</span>
                        </div>
                        <div>
                            <CheckIcon v-if="selected" class="h-5 w-5" aria-hidden="true" />
                        </div>
                    </div>
                </ComboboxOption>
            </ComboboxOptions>
        </div>
    </Combobox>
</template>

<script setup>
import { ref, computed, watch, defineEmits } from 'vue'

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
    value: {
        type: [String],
        default: ''
    }
})

const emit = defineEmits(['update:modelValue'])

import * as FaIcons from "oh-vue-icons/icons/fa";

const Fa = Object.values({ ...FaIcons });

const selectedItem = ref(props.value)

const displayValue = (option) => {
    return option
}

watch(selectedItem, (newValue, oldValue) => {
    emit("update:modelValue", newValue)
})

const query = ref('')

const filteredItems = computed(() =>
    query.value === ''
        ? Fa.slice(0, 20)
        : Fa.filter((option) => {
            return option.name.toLowerCase().includes(query.value.toLowerCase())
        }).slice(0, 20)
)
</script>