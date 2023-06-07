<template>
    <div class="flex items-center justify-between px-4">
        <button @click="showModal = true" type="button"
            class="flex items-center justify-center space-x-2 font-medium text-slate-600 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
            <x-icon name="fa-plus" class="h-6 w-6"  />
            <span>{{ $t('New Field') }}</span>
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
                                {{ $t('Select field')}}
                            </DialogTitle>
                            <button @click="showModal = !showModal"
                                class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <x-icon name="fa-times" class="h-4.5 w-4.5" />
                            </button>
                        </DialogPanel>
                        <div class="px-4 py-4 sm:px-5">
                            <div class="my-2 gap-2 grid grid-cols-1 md:grid-cols-2">
                                <template v-for="({ icon, name, id }, index) in fields" :key="index">
                                    <button type="button" @click="$emit('add', id)"
                                        class="flex border border-dashed rounded-sm items-center space-x-2.5 px-4 py-1 font-inter hover:bg-slate-150 dark:hover:bg-navy-600">
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


const cancel = () => {
    showModal.value = false
}

const apply = async () => {
    showModal.value = false
}
</script>