<template>
    <TransitionRoot appear :show="isOpenModal" as="template">
        <Dialog as="div" class="relative z-50">
            <TransitionChild v-if="shadow" as="template" enter="duration-300 ease-out" enter-from="opacity-0"
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
                                <p class="text-lg ">Tem certeza de que deseja excluir?</p>
                            </DialogTitle>
                            <div class="mt-2 text-slate-700 dark:text-navy-200">
                                Depois que for excluída, todos os seus recursos e dados serão excluídos permanentemente.
                            </div>
                            <div class="my-4 mt-6 h-px bg-slate-200 dark:bg-navy-500"></div>
                            <div class="space-x-2 text-right">
                                <x-button @click="cancel" styles="default" rounded="rounded-full" variant="error">
                                    {{ $t('Cancel') }}
                                </x-button>
                                <button @click="apply"
                                    class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    {{ $t('Apply') }}
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
    <!-- <x-notification v-bind="message" /> -->
</template>
<script >
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import ErrorService  from "@/services/ErrorService";
export default {
    components: {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
    },
    props: {
        endpoint: {
            type: [String, Object, Boolean],
            default: false
        }
    },
    data() {
        return {
            message: { text: '', title: '', icon: 'fa-regular-grin-squint-tears' },
            shadow: true,
            isOpenModal: true
        }
    },
    methods: {
        async apply() {
            const { params, name } = this.$route
            let endpoint = ''
            if (this.endpoint) {
                endpoint = this.endpoint
            } else {
                endpoint = name.replace('.list', '').replace('.destroy', '')
            }
            try {
                const { data } = await this.$table.delete(endpoint.concat('/').concat(params.id))
                const { message } = data
                if (message) {
                    this.$notification({ text: message.content, variant: 'success' })
                }
                this.$router.go(-1)

            } catch (err) {
                ErrorService.displayErrorAlert(err);
                this.$router.go(-1)
            }

        },
        cancel() {

            this.$router.go(-1)

        }
    }
}


// import { useRoute, useRouter } from 'vue-router';

// const router = useRouter()

// const route = useRoute()

</script>