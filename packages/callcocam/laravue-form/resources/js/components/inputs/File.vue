<template>
    <div :class="context.classes.element" :data-type="context.type">
        <CLabelslot :context="context">
            <input ref="file" :data-is-drag-hover="isOver" type="file" v-bind="attributes" @blur="context.blurHandler"
                @change="handleFile" @dragover="handleDragOver" @dragleave="handleDragLeave">
            <component :is="context.slotComponents.uploadAreaMask" v-show="!hasFiles" :class="context.classes.uploadAreaMask">
            <div :class="context.classes.uploadAreaMaskContent">
                <CIconslot :icon="context.icon" :scale="context.scale" :class="context.classes.uploadAreaMaskContent" />
            </div>
            </component>
        </CLabelslot>
        <slot />
        <Files v-if="hasFiles" :file="context.model"
            :image-preview="context.type === 'image' && context.imageBehavior === 'preview'" :context="context" />
    </div>
</template>
<script>
import Mixin from './../../mixin'
import Upload from '../../upload'
import Files from '../Files.vue'
export default {
    components: {
        Files
    },
    mixins: [
        Mixin
    ],
    data() {
        return {
            isOver: false
        }
    },
    computed: {
        hasFiles() {
            return !!(this.context.model instanceof Upload && this.context.model.files.length)
        }
    },
    created() {
        if (Array.isArray(this.context.model)) {
            if (typeof this.context.model[0][this.$form.getFileUrlKey()] === 'string') {
                this.context.model = this.$form.createUpload({
                    files: this.context.model
                }, this.context)
            }
        }
    },
    mounted() {
        if (window && this.context.preventWindowDrops) {
            window.addEventListener('dragover', this.preventDefault)
            window.addEventListener('drop', this.preventDefault)
        }
    },
    destroyed() {
        if (window && this.context.preventWindowDrops) {
            window.removeEventListener('dragover', this.preventDefault)
            window.removeEventListener('drop', this.preventDefault)
        }
    },

    methods: {
        preventDefault(e) {
            if (e.target.tagName !== 'INPUT' && e.target.getAttribute('type') !== 'file') {
                e = e || event
                e.preventDefault()
            }
        },
        handleFile() {
            this.isOver = false
            const input = this.$refs.file
            if (input.files.length) {
                this.context.model = this.$form.createUpload(input, this.context)
                this.$nextTick(() => this.attemptImmediateUpload())
            }
        },
        attemptImmediateUpload() {
            if (this.context.uploadBehavior === 'live' &&
                this.context.model instanceof Upload) {
                this.context.hasValidationErrors().then(errors => {
                    if (!errors) {
                        this.context.model.upload()
                    }
                })
            }
        },
        handleDragOver(e) {
            e.preventDefault()
            this.isOver = true
        },
        handleDragLeave(e) {
            e.preventDefault()
            this.isOver = false
        }
    }

}
</script>