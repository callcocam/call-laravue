<template>
    <div :class="context.classes.element" :data-type="context.type">
        <FileManager title="Editor" :isOpen="isOpen" :key="context.id" @selectedFile="selectedFile" @close="closeModal"
            :formValue=false />
        <CLabelslot :context="context">
            <editor :id="'EDITOR'" api-key="qe6snq4uwbfhat2a9pi2exb9bsp0yfhrz6rtq22vq2ovgrnz" :init="options"
                :initial-value="context.model" />
            <slot />
        </CLabelslot>
    </div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue';
import Mixin from '@form-manager/mixin'
import { onMounted, reactive, ref } from 'vue';
import FileManager from '@file-manager/components/Main.vue'
export default {
    mixins: [
        Mixin
    ],
    components: {
        FileManager,
        'editor': Editor // <- Important part
    },
    setup() {
        let tinyMCE = null;
        const isOpen = ref(false)
        const obj = reactive({
            url: '',
            title: ''
        })
        const selectedFile = (e) => {
            closeModal()
            obj.url = e.link_url
            obj.title = e.name 
            tinymce.activeEditor.insertContent(`<img src="${obj.url}" title="${obj.title}" alt="${obj.title}" />`)
        }

        const closeModal = () => isOpen.value = false
        const opneModal = () => isOpen.value = true
        const options = {
            height: 500,
            language: 'pt_BR',
            skin_url: '/editor/callcocam',
            menubar: true,
            content_css: 'dark',
            statusbar: false,
            setup: (editor) => {
                editor.on('init', (e) => {
                    tinyMCE = editor
                });
                 editor.ui.registry.addButton('filemanagerimage', {
                    title: 'Enviar Imagem',
                    icon: 'image',
                    onAction: () => {              
                        opneModal()
                    }
                })
            },
            imagemanager_insert_template: `<img src="${obj.url}" title="${obj.title}" alt="${obj.title}" />`,
            plugins: [
                'advlist', 'autolink',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlst outdent indent | removeformat | a11ycheck code table filemanagerimage help'
        }
        return { options, isOpen, closeModal, selectedFile, opneModal }
    }

}
</script>