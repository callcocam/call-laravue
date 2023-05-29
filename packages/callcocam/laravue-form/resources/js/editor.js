import Editor from '@tinymce/tinymce-vue';
import FileManager from '@file-manager/components/Main.vue'
export default {
    props: {
        context: {
            type: Object,
            required: true
        }
    },
    components: {
        FileManager,
        'editor': Editor
    },
    data() {
        return {
            options: {
                height: 540,
                language: 'pt_BR',
                skin_url: '/editor/callcocam',
                menubar: true,
                content_style: '',
                content_css:[ 'dark', '/css/tyneMCE.css'],
                statusbar: false,
                setup: (editor) => {
                    editor.on('init', (e) => {
                        tinyMCE = editor
                    });
                    editor.ui.registry.addButton('filemanagerimage', {
                        title: 'Enviar Imagem',
                        icon: 'image',
                        onAction: () => this.opneModal()
                    })
                },
                plugins: [
                    'advlist', 'autolink',
                    'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                    'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlst outdent indent | removeformat | a11ycheck code table filemanagerimage help'
            },
            isOpen: false,
            obj: {
                url: '',
                title: ''
            }
        }
    },
    methods: {
        selectedFile(e) {
            this.closeModal() 
            tinymce.activeEditor.insertContent(`<img src="${e.link_url}" title="${e.title}" alt="${e.title}" />`)
            tinymce.triggerSave()
        },
        closeModal() { this.isOpen = false },
        opneModal() { this.isOpen = true }
    },
}
