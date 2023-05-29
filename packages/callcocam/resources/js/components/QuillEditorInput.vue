<template>
    <div :class="context.classes.element" :data-type="context.type">
        <CLabelslot :context="context">
            <QuillEditor :modules="modules" theme="snow" toolbar="#toolbar" :options="options">

                <template #toolbar>
                    <div id="toolbar">
                        <span class="ql-formats">
                            <select class="ql-font"></select>
                            <select class="ql-size"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-bold"></button>
                            <button class="ql-italic"></button>
                            <button class="ql-underline"></button>
                            <button class="ql-strike"></button>
                        </span>
                        <span class="ql-formats">
                            <select class="ql-color"></select>
                            <select class="ql-background"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-script" value="sub"></button>
                            <button class="ql-script" value="super"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-header" value="1"></button>
                            <button class="ql-header" value="2"></button>
                            <button class="ql-blockquote"></button>
                            <button class="ql-code-block"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-list" value="ordered"></button>
                            <button class="ql-list" value="bullet"></button>
                            <button class="ql-indent" value="-1"></button>
                            <button class="ql-indent" value="+1"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-direction" value="rtl"></button>
                            <select class="ql-align"></select>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-link"></button>
                            <button class="ql-image"></button>
                            <button class="ql-video"></button>
                            <button class="ql-formula"></button>
                        </span>
                        <span class="ql-formats">
                            <button class="ql-clean"></button>
                        </span>
                    </div>
                </template>

            </QuillEditor>
            <!-- <QuillEditor :modules="modules" /> -->
            <slot />
        </CLabelslot>
    </div>
</template>
<script>
import { QuillEditor, Quill } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import Counter from './modules/Counter';
import FileManager from './modules/FileManager';

import Mixin from '@form-manager/mixin'

export default {
    mixins: [
        Mixin
    ],

    components: {
        QuillEditor
    },
    setup() {
        // Quill.register('modules/counter', Counter);
        const modules = [
            {
                name: 'Counter',
                module: Counter,
                options: {

                }
            },
            {
                name: 'FileManager',
                module: FileManager,
                options: {

                }
            }
        ]
        const options = {
            content: 'html'
        }
        return { options, modules }
    }

}
</script>