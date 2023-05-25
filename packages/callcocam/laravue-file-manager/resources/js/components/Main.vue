<template>
    <TransitionRoot appear :show="showOpen" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-50">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>
            <div class="fixed inset-0 overflow-hidden ">
                <div class="flex min-h-full items-center justify-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full flex md:max-w-5xl transform overflow-hidden rounded-md bg-white shadow-xl transition-all dark:bg-navy-700 fm-has-min-sidebar relative"
                            :class="{ 'fm-is-sidebar-open': isSidebarExpanded }">
                            <div class="sidebar">
                                <f-sidebar-main v-if="user" :context="context" />
                            </div>
                            <main class="w-full fm-main-content  relative">
                                <f-header-header :context="context" />
                                <div class="flex flex-col pt-5 transition-all duration-[.25s]">
                                    <div class="flex items-center space-x-1">
                                        <h3 class="text-lg font-medium text-slate-700 line-clamp-1 dark:text-navy-50">
                                            Home <template v-if="directory.hasOwnProperty('path')">
                                                / {{ _capitalize(directory.path) }}
                                            </template>
                                            <template v-if="selectedFile.hasOwnProperty('name')">
                                                / {{ _capitalize(selectedFile.name) }}
                                            </template>
                                        </h3>
                                    </div>
                                    <div class=" w-full content-start">
                                        <f-files :context="context" />
                                        <f-resume :context="context" />
                                    </div>
                                </div>
                            </main>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
    <slot />
</template>
<script>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import context from '@file-manager/context';
import { useManagerModalStore } from '@file-manager/stores/modal'
import { useManagerParamsStore } from '@file-manager/stores/params';
import { useManagerDirStore } from '@file-manager/stores/dirs';
import { useManagerFilesStore } from '@file-manager/stores/files';

import { useManagerGlogalStore } from "@file-manager/stores/global"
import { capitalize } from 'lodash'
export default {
    components: {
        TransitionRoot,
        TransitionChild,
        Dialog,
        DialogPanel,
        DialogTitle,
    },
    model: {
        prop: 'formValue',
        event: 'input'
    },
    emits: ['selectedFile'],
    props: {
        imageBehavior: {
            type: String,
            default: 'preview'
        },
        uploadUrl: {
            type: [String, Boolean],
            default: false
        },
        uploader: {
            type: [Function, Object, Boolean],
            default: false
        },
        uploadBehavior: {
            type: String,
            default: 'live'
        },
        formValue: {
            default: ''
        },
    },
    data() {
        return {
            user: true,
            proxy: '',
            mntd: false
        }
    },
    computed: {
        ...context,
        showOpen() {
            return useManagerModalStore().showModal
        },
        params() {
            const params = useManagerParamsStore().params

            return params
        },
        isSidebarExpanded() {
            const global = useManagerGlogalStore()
            return global.isSidebarExpanded
        },
        directory() {
            return useManagerDirStore().directory
        },
        selectedFile() {
            const selectedFile = useManagerFilesStore().selectedFile

            if (selectedFile.hasOwnProperty('url')) {
                this.$emit('selectedFile', selectedFile)
            }
            return selectedFile
        }
    },
    watch: {
        proxy: {
            handler: function (newValue, oldValue) {
                this.$emit('update:modelValue', newValue)
            },
            deep: true
        },
        formValue: {
            handler: function (newValue, oldValue) {
                this.$emit('update:modelValue', newValue)
            },
            deep: true
        }
    },
    mounted() {
        this.mntd = true
    },
    created() {
        if (typeof this.formValue == 'string') {
            this.$APIHttp.getServiceFile(this.formValue).then(resp => {
                const { data } = resp
                const { folder } = data
                useManagerFilesStore().setFile(data)
                if (folder) {
                    useManagerDirStore().setDirectory(folder)
                    const { file_manager_id, id } = folder
                    useManagerParamsStore().setParams({ file_manager_id:id })
                }
            })

        }
    },
    methods: {
        _capitalize(name) {
            return capitalize(name)
        },
        closeModal() {
            useManagerModalStore().setShowModal()
        },
        openModal() {
            useManagerModalStore().setShowModal()
        }
    }
}
</script>