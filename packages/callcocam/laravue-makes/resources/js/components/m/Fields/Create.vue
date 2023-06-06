<template>
    <div class="flex items-center justify-between px-4">
        <span>ADD NEW FIELD</span>
        <button type="button" @click="showModal = true"
            class="btn h-6 w-6 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
            </svg>
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
                            <div class="mt-1 space-y-2">
                                <div class="flex space-x-2 w-full">
                                    <label class="block flex-1">
                                        <span>Tipo:</span>
                                        <select v-model="form.type"
                                            class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                            <option>--Selecion um tipo--</option>
                                            <option v-for="(type, index) in types" :key="type" :value="type">{{ type }}
                                            </option>
                                        </select>
                                    </label>
                                    <label class="block">
                                        <span>Tamanho</span>
                                        <select v-model="form.span"
                                            class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </label>
                                </div>
                                <label class="block z-40">
                                    <span>Classes:</span>
                                    <x-m-fields-combobox-icons  />
                                </label>
                                <label class="block">
                                    <span>Classes:</span>
                                    <textarea v-model="form.classes" rows="2"
                                        placeholder=" Classes secundarias, não substituirá as classes padrões"
                                        class="form-textarea mt-1.5 w-full resize-none rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"></textarea>
                                </label>
                                <label class="block">
                                    <span>Descrição:</span>
                                    <textarea rows="4" placeholder=" Enter Text"
                                        class="form-textarea mt-1.5 w-full resize-none rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"></textarea>
                                </label>
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
import { ref } from 'vue'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'

const types = ref(
    [
        'text',
        'hidden',
        'email',
        'phone',
        'date',
        'month',
        'tel',
        'datetime-local',
        'file',
        'password',
        'number',
        'range',
        'color',
        'textarea',
        'radio',
        'checkbox',
        'select',
        'file-manager',
    ]
)
const showModal = ref(false)
const form = ref({})
</script>