<template>
   <TransitionRoot appear :show="isOpenModal" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-50">
                <TransitionChild v-if="shadow" as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>
                <div class="fixed inset-0 overflow-y-auto ">
                    <div class="flex min-h-full items-center justify-center p-4 text-center ">
                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95">
                            <DialogPanel
                                class="w-full max-w-md transform overflow-hidden  rounded-lg bg-white  duration-300 dark:bg-navy-700 p-6 text-left align-middle shadow-xl transition-all"
                                v-bind="$attrs">
                                <DialogTitle as="h3" class="text-base font-medium text-slate-700 dark:text-navy-100">
                                    <slot name="header"></slot>
                                </DialogTitle>
                                <div class="mt-2">
                                    <slot />
                                </div>
                                <div class="space-x-2 text-right">
                                    <f-btn-error @click="closeModal()">
                                        {{ $t('Cancel') }}
                                    </f-btn-error>
                                    <slot name="footer"></slot>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
</template>
<script setup>
import { ref, defineEmits, computed } from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
const props = defineProps({
    shadow: {
        type: Boolean,
        default: false
    },
    isOpen: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['closeModal'])

const isOpenModal = computed(() => props.isOpen)

function closeModal() {
    emit('closeModal', false)
}

</script>