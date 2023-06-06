<template>
    <div class="flex items-center justify-between px-4">
        <button @click="showModal = true" type="button"
            class="flex items-center justify-center space-x-2 font-medium text-slate-600 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
            <x-icon name="fa-plus" class="h-6 w-6" fill="none" />
            <span>New Field</span>
        </button>
        <TransitionRoot as="template" :show="showModal">
            <Teleport to="#x-teleport-target">
                <Dialog
                    class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                    role="dialog" @keydown.window.escape="showModal = false">
                    <TransitionChild class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
                        @click="showModal = false" enter="ease-out" enter-from="opacity-0" enter-to="opacity-100"
                        leave="ease-in" leave-from="opacity-100" leave-to="opacity-0"></TransitionChild>
                    <TransitionChild
                        class="relative w-full max-w-lg origin-top rounded-lg bg-white transition-all duration-300 dark:bg-navy-700"
                        enter="easy-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="easy-in"
                        leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                            <DialogTitle class="text-base font-medium text-slate-700 dark:text-navy-100">
                                Edit Pin
                            </DialogTitle>
                            <button @click="showModal = !showModal"
                                class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </DialogPanel>
                        <div class="px-4 py-4 sm:px-5">
                            <div class="mt-1 space-y-1">
                                <template v-for="({ icon, name, id }, index) in fields" :key="index">
                                    <button type="button" @click="$emit('add', id)"
                                        class="flex cursor-move items-center space-x-2.5 px-4 py-1 font-inter hover:bg-slate-150 dark:hover:bg-navy-600">
                                        <div class="avatar h-10 w-10 items-center">
                                            <x-icon :name="icon" class="w-7 h-7" />
                                        </div>
                                        <div class="flex flex-1 flex-col">
                                            <div class="flex items-baseline justify-between space-x-1.5">
                                                <p
                                                    class="text-xs+ font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                                                    {{ name }}
                                                </p>
                                            </div>
                                        </div>
                                    </button>
                                </template>

                                <div class="space-x-2 text-right">
                                    <button @click="showModal = false"
                                        class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                        Cancel
                                    </button>
                                    <button @click="showModal = false"
                                        class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </TransitionChild>
                </Dialog>
            </Teleport>
        </TransitionRoot>
    </div>
</template>
<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { computed, ref } from 'vue';

const props = defineProps({
    fields: {
        type: [Object, Array, Boolean],
        default: false
    }
})
const showModal = ref(false)

const form = ref({})
</script>