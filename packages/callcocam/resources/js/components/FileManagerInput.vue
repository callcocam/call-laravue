<template>
    <div :class="context.classes.element" :data-type="context.type">
        <f-main @selectedFile="selectedFile" :formValue="context.value">
            <CLabelslot :context="context">
                <div class="relative flex -space-x-px">
                    <input v-model="context.model" type="text" v-bind="attributes" @blur="context.blurHandler" />
                    <button type="button" @click="setIsOpen"
                        class="px-4 flex items-center rounded-r-lg bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                        <v-icon name="fa-upload" scale="2" class="h-5 w-5 transition-colors duration-200" />
                    </button>
                </div>
            </CLabelslot>
        </f-main>
    </div>
</template>
<script>
import { useManagerModalStore } from '@file-manager/stores/modal'
import Mixin from '@form-manager/mixin'
export default {
    mixins: [
        Mixin
    ],
    data() {
        return {
            isOpen: false
        }
    },
    methods: {
        setIsOpen() {
            useManagerModalStore().setShowModal()
        },
        selectedFile(e) {
            this.context.model = e.id
        }
    }

}
</script>