<template>
    <TransitionRoot as="template" :show="showModal">
        <Teleport to="#x-teleport-target">
            <Dialog as="div" class="relative z-50">
                <TransitionChild  as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black/50 bg-opacity-25" />
                </TransitionChild>
                <div class="fixed inset-0 overflow-y-auto ">
                    <div class="flex min-h-full items-center justify-center p-4 text-center ">
                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95">
                            <DialogPanel
                                class="w-full max-w-md text-center transform overflow-hidden  rounded-lg bg-white  duration-300 dark:bg-navy-700 p-6   align-middle shadow-xl transition-all">
                                <DialogTitle as="div" class="text-base font-medium text-slate-700 dark:text-navy-100 py-2">
                                    <h2 class="text-2xl px-3 text-red-500">Atenção</h2>
                                    <p class="text-lg ">Tem certeza de que deseja excluir o <b>ELEMENTO</b>?</p>
                                </DialogTitle>
                                <div class="mt-2 text-slate-700 dark:text-navy-200">
                                    Depois que for excluída, todos os seus recursos e dados serão excluídos
                                    permanentemente.
                                </div>
                                <div class="my-4 mt-6 h-px bg-slate-200 dark:bg-navy-500"></div>
                                <div class="space-x-2 text-right">
                                    <x-button @click="cancel" styles="default" rounded="rounded-full" variant="error">
                                        {{ $t('Cancel') }}
                                    </x-button>
                                    <x-button @click="apply" styles="default" rounded="rounded-full">
                                        {{ $t('Apply') }}
                                    </x-button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </Teleport>
    </TransitionRoot>
</template>
<script setup>
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import ErrorService from "@/services/ErrorService";
import { useManagerMakeElementStore } from '@laravue-makes/stores/element'
import { computed, defineEmits } from 'vue';

const emit = defineEmits(['loadBoards'])

import { inject, ref } from 'vue';

const showModal = computed(() => useManagerMakeElementStore().getShowDelete)

const form = computed(() => useManagerMakeElementStore().getFormValue)

const closeDrawer = () => {
    useManagerMakeElementStore().setShowEdit(false)
    useManagerMakeElementStore().setFormValue({})
}

const cancel = () => {
    useManagerMakeElementStore().setShowDelete(false)
    useManagerMakeElementStore().setFormValue({})
}

const MAKEAPP = inject('MAKE')

const apply = async () => {
    try {
        const { data } = await MAKEAPP.delete(('make/board/items/').concat(form.value.id))
        const { message } = data
        if (message) {
            ErrorService.displaySuccessAlert(message);
        }
        useManagerMakeElementStore().setShowDelete(false)
        useManagerMakeElementStore().setFormValue({})
        emit('loadBoards', true)
    } catch (error) {
        ErrorService.displayErrorAlert(error);
    }
}
</script>