<template>
    <div class="flex items-center justify-between px-4">
        <button @click="showModal = true" type="button"
            class="btn w-full bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
            <x-icon name="fa-plus" class="h-6 w-6" fill="none" />
            <span>New Board</span>
        </button>
        <TransitionRoot as="template" :show="showModal">
            <Teleport to="#x-teleport-target">
                <Dialog
                    class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                    role="dialog" @keydown.window.escape="showModal = false">
                    <TransitionChild class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
                        enter="ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in"
                        leave-from="opacity-100" leave-to="opacity-0"></TransitionChild>
                    <TransitionChild
                        class="relative w-full max-w-lg origin-top rounded-lg bg-white transition-all duration-300 dark:bg-navy-700"
                        enter="easy-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="easy-in"
                        leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                        <DialogPanel class="flex flex-col rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                            <DialogTitle
                                class="flex justify-between text-base font-medium text-slate-700 dark:text-navy-100">
                                <span>
                                    {{ $t('Create new board') }}
                                </span>
                                <button @click="showModal = !showModal"
                                    class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <x-icon name="fa-times" class="h-4.5 w-4.5" />
                                </button>
                            </DialogTitle>
                            <div class="px-2 py-2">
                                <div class="mt-1 space-y-2">
                                    <div class="flex space-x-2 items-center">
                                        <label class="block flex-1">
                                            <span>{{ $t('Name') }}</span>
                                            <input v-model="form.name"
                                                class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                                                :placeholder="$t('Name')" type="text" />
                                        </label>
                                        <label class="block w-24">
                                            <span>{{ $t('With') }}</span>
                                            <input v-model="form.span"
                                                class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                                                placeholder="12" min="1" max="12" type="number" />
                                        </label>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <label class="block w-full">
                                            <span>{{ $t('Icone') }}:</span>
                                            <x-m-fields-combobox-icons @update:modelValue="form.icon = $event" />
                                        </label>
                                        <label class="block w-32">
                                            <span>{{ $t('Ordering') }}</span>
                                            <input v-model="form.ordering"
                                                class="form-input mt-1.5 w-full rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                                                :placeholder="$t('Ordering')" type="number" min="0" />
                                        </label>
                                    </div>
                                    <label class="block">
                                        <span>{{ $t('Description') }}:</span>
                                        <textarea v-model="form.description" rows="2" :placeholder="$t('Description')"
                                            class="form-textarea mt-1.5 w-full resize-none rounded-lg bg-slate-150 px-3 py-2 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"></textarea>
                                    </label>
                                    <div class="space-x-2 text-right">
                                        <x-button @click="cancel" styles="default" rounded="rounded-full" variant="error">
                                            {{ $t('Cancel') }}
                                        </x-button>
                                        <x-button @click="apply" styles="default" rounded="rounded-full">
                                            {{ $t('Apply') }}
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </Dialog>
            </Teleport>
        </TransitionRoot>
    </div>
</template>
<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { map } from 'lodash';
import ErrorService from "@/services/ErrorService";
import { inject, ref, defineEmits } from 'vue';

const emit = defineEmits(['loadBoards'])

const props = defineProps({
    makeId: {
        type: String,
    }
})

const MAKEAPP = inject('MAKE')

const showModal = ref(false)

const form = ref({})

const cancel = () => {
    showModal.value = false
}

const apply = async () => {
    const formData = new FormData()
    map(form.value, (item, name) => {
        formData.append(name, item)
    })
    formData.append('make_id', props.makeId)
    formData.append('status', 'published')
    try {
        const { data } = await MAKEAPP.post('make/boards', formData)
        const { message } = data
        if (message) {
            ErrorService.displaySuccessAlert(message);
        }
        showModal.value = false
        emit('loadBoards', true)
    } catch (error) {
        ErrorService.displayErrorAlert(error);
    }
}
</script>