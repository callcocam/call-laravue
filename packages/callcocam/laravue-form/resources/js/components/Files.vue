<template>
  <ul v-if="fileUploads.length" :class="context.classes.files">
    <li v-for="file in fileUploads" :key="file.uuid" :data-has-error="!!file.error"
      :data-has-preview="!!(imagePreview && file.previewData)">
      <CFormSlot name="file" :context="context" :file="file" :image-preview="imagePreview">
        <component :ref="file.uuid" :is="context.slotComponents.file" :context="context" :file="file" :image-preview="imagePreview" />
      </CFormSlot>
      <div v-if="file.error" :class="context.classes.fileUploadError" v-text="file.error" />
    </li>
    <div v-if="isMultiple && context.addLabel" :class="context.classes.fileAdd" role="button">
      {{ context.addLabel }}
      <input ref="addFiles" type="file" multiple :class="context.classes.fileAddInput" @change="appendFiles">
    </div>
  </ul>
</template>

<script>
import { has } from 'lodash'
import Upload from './../upload'

export default {
  name: 'Files',
  props: {
    file: {
      type: Upload,
      required: true
    },
    imagePreview: {
      type: Boolean,
      default: false
    },
    context: {
      type: Object,
      required: true
    }
  },
  computed: {
    fileUploads() {
      return this.file.getFiles() || []
    },
    isMultiple() {
      return has(this.context.attributes, 'multiple')
    }
  },
  watch: {
    files() {
      if (this.imagePreview) {
        this.file.loadPreviews()
      }
    }
  },
  mounted() {
    if (this.imagePreview) {
      this.file.loadPreviews()
    }
  },
  methods: {
    appendFiles() {
      const input = this.$refs.addFiles
      if (input.files.length) {
        this.file.mergeFileList(input)
      }
    }
  }
}
</script>
