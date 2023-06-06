<template>
    <div class="fixed right-0 top-0 z-[101] h-full w-full md:w-96">
        <div class="flex h-full w-full transform-gpu flex-col bg-white transition-transform duration-200 dark:bg-navy-700"
            enter="ease-out" enter-from="translate-x-full" enter-to="translate-x-0" leave="ease-in"
            leave-from="translate-x-0" leave-to="translate-x-full">
            <div class="flex h-14 items-center justify-between bg-slate-150 p-4 dark:bg-navy-800">
                <h3 v-if="element" class="text-base font-medium text-slate-700 dark:text-navy-100">
                    {{ element.label }}
                </h3>
                <div class="-mr-1.5 flex items-center space-x-2.5">
                    <div class="flex">
                        <button v-if="element"
                            class="btn h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <x-icon :name="element.icon" class="h-5 w-5 " />
                        </button>
                        <button @click="closeDrawer"
                            class="btn h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="is-scrollbar-hidden flex grow flex-col space-y-2 overflow-y-auto p-4">
                <div class="flex items-center space-x-2">
                    <label class="block">
                        <span>Elemento label</span>
                        <input v-model="element.label"
                            class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                            placeholder="Enter todo title" type="text" />
                    </label>
                    <label class="block">
                        <span>Elemento name</span>
                        <input v-model="element.name"
                            class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                            placeholder="Enter todo title" type="text" />
                    </label>
                </div>
                <div class="flex items-center space-x-2">
                    <label class="block">
                        <span>Placeholder</span>
                        <input v-model="element.placeholder"
                            class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                            placeholder="Enter todo title" type="text" />
                    </label>
                    <label class="block">
                        <span>Tamanho</span>
                        <select v-model="element.span"
                            class="form-select mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:hover:bg-navy-900 dark:focus:bg-navy-900">
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
                <label class="block">
                    <span>Elemento Help</span>
                    <textarea rows="2" placeholder="Help..."
                        class="form-textarea mt-1.5 w-full resize-none rounded-lg bg-slate-150 p-2.5 placeholder:text-slate-400 dark:bg-navy-900 dark:placeholder:text-navy-300"></textarea>
                </label>
                <template v-if="element.options">
                    <label class="block">
                        <span>Elemento Fonte</span>
                        <input v-model="element.model"
                            class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                            placeholder="Nome da model" type="text" />
                    </label>
                </template>
            </div>
            <div class="flex items-center justify-between border-t border-slate-150 py-3 px-4 dark:border-navy-600">
                <div class="flex space-x-1">
                    <button
                        class="btn h-8 w-8 rounded-full p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    <button
                        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </button>
                </div>
                <button @click="closeDrawer"
                    class="btn min-w-[7rem] bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                    Save
                </button>
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed, ref } from 'vue';

const emit = defineEmits(['closeDrawer'])

const props = defineProps({
    element: {
        type: [Boolean, Object],
        default: false
    }
})

const isImportant = ref(false)

const closeDrawer = () => {
    emit('closeDrawer', false)
}
</script>