
import moment from 'moment'; // Importe a biblioteca Moment.js
moment.locale('pt-br');
window.moment = moment
window.moment.locale('pt-br')
 
 

import { createApp } from "vue";

import { createPinia } from 'pinia'

import { OhVueIcon, addIcons } from "oh-vue-icons";

import { vInfiniteScroll } from '@vueuse/components'

import App from './App.vue'


const app = createApp(App);

app.use(createPinia())

import * as FaIcons from "oh-vue-icons/icons/fa";

const Fa = Object.values({ ...FaIcons });

addIcons(...Fa);

app.component('v-icon', OhVueIcon)

import Form from '@form-manager'

import Menu from '@laravue-menus';

import Make from '@laravue-makes';

import Siga from '@/components';



import { useApi } from "./api/useAPI";
import popper from "./directives/popper";
import i18nPlugin from './plugins/i18n'
import tooltip from "./directives/tooltip";
import expandedItem from './directives/expanded-item';

app.use(i18nPlugin, {
    'Update photo': 'Alterar foto de perfil',
    'Change': 'Atualizar'
})


import baseClasses from './components/classes';


import "@file-manager/css/app.css";
import FileManager from '@file-manager'
import FileManagerInput from './components/FileManagerInput.vue'

app.component('FileManagerInput', FileManagerInput)

import QuillEditorInput from './components/QuillEditorInput.vue'
app.component('QuillEditorInput', QuillEditorInput)

import TinymceInput from './components/TinymceInput.vue'
app.component('TinymceInput', TinymceInput)

app.use(Form, {
    uploader: useApi(),
    service: useApi(),
    baseClasses,
    elements: {
        'file-manager': {
            classification: 'file-manager',
            component: 'FileManagerInput'
        },
        'quill': {
            classification: 'quill',
            component: 'QuillEditorInput'
        },
        'tinymce': {
            classification: 'tinymce',
            component: 'TinymceInput'
        }
    }
});

app.use(Siga, {});

app.use(FileManager, {
    http: useApi()
});

app.use(Menu, {
    http: useApi()
})
app.use(Make, {})


app.directive('InfiniteScroll', vInfiniteScroll)
app.directive("expanded-item", expandedItem);
app.directive('popper', popper)
app.directive("tooltip", tooltip);

import { cretaeRoutes } from './routers';

useApi().get("load/menus").then(resp => {

    app.use(cretaeRoutes(resp.data));

    app.mount("#root");

})