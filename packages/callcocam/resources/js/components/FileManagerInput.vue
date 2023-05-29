<template>
    <div :class="context.classes.element" :data-type="context.type">
        <FileManager title="FileManager" :isOpen="isOpen" :key="context.id" @selectedFile="selectedFile" :formValue="context.value" />
        <CLabelslot :context="context">
            <div class="relative flex -space-x-px">
                <input v-model="context.model" type="text" v-bind="attributes" @blur="context.blurHandler" />
                <a v-if="file && file.hasOwnProperty('link_url')" :href="file.link_url" target="_blank"
                    class="px-4 flex items-center bg-warning font-medium text-white hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90">
                    <v-icon name="fa-eye" scale="2" class="h-5 w-5 transition-colors duration-200" />
                </a>
                <button type="button" @click="setIsOpen"
                    class="px-4 flex items-center rounded-r-lg bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                    <v-icon name="fa-upload" scale="2" class="h-5 w-5 transition-colors duration-200" />
                </button>
            </div>
        </CLabelslot>
    </div>
</template>
<script>

import FileManager from '@file-manager/components/Main.vue'
import Mixin from '@form-manager/mixin'
export default {
    mixins: [
        Mixin
    ],
    components: {
        FileManager
    },
    data() {
        return {
            isOpen: false,
            file: this.context.models
        }
    },
    computed: {
    },
    methods: {
        closeModal() {
            this.isOpen = false
        },
        setIsOpen() {
            this.isOpen = true
        },
        selectedFile(e) {
            this.context.model = e.id
            this.file = e
            this.closeModal()
        }
    }

}
</script>