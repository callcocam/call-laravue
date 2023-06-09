
import moment from 'moment'; // Importe a biblioteca Moment.js
moment.locale('pt-br');
window.moment = moment
window.moment.locale('pt-br')



import { createApp } from "vue";

import { createPinia } from 'pinia'

import { OhVueIcon, addIcons } from "oh-vue-icons";

import { vInfiniteScroll } from '@vueuse/components'

import App from './App.vue'

import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';

import ErrorService from "./services/ErrorService";

const app = createApp(App);


app.use(VueSweetalert2, {
    customClass: {
        popup: 'bg-white px-4 py-10 text-center transition-opacity duration-300 dark:bg-navy-700 text-slate-700 dark:text-navy-100',
        confirmButton: 'btn bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90',
        closeButton: 'btn bg-info font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90',
        cancelButton: 'btn bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90'
    }
});


app.config.errorHandler = (error) => ErrorService.onError(error);

app.use(createPinia())

import * as FaIcons from "oh-vue-icons/icons/fa";

const Fa = Object.values({ ...FaIcons });

addIcons(...Fa);

app.component('v-icon', OhVueIcon)

import Form from '@form-manager'

import Menu from '@laravue-menus';

import Make from '@laravue-makes';

import Table from '@laravue-table';

import Siga from '@/components';



import { useApi } from "./api/useAPI";
import popper from "./directives/popper";
import i18nPlugin from './plugins/i18n'
import notification from './plugins/magics/notification'
import tooltip from "./directives/tooltip";
import expandedItem from './directives/expanded-item';
import expanded from './directives/expanded';
import draggable from './directives/draggable';

app.use(i18nPlugin, {
    'Update photo': 'Alterar foto de perfil',
    'Change': 'Atualizar'
})

app.use(notification, {})


import baseClasses from './components/classes';


import "@file-manager/css/app.css";
import FileManager from '@file-manager'
import FileManagerInput from './components/FileManagerInput.vue'

app.component('FileManagerInput', FileManagerInput)

// import QuillEditorInput from './components/QuillEditorInput.vue'
// app.component('QuillEditorInput', QuillEditorInput)

// import TinymceInput from './components/TinymceInput.vue'
// app.component('TinymceInput', TinymceInput)

app.use(Form, {
    uploader: useApi(),
    service: useApi(),
    baseClasses,
    elements: {
        'file-manager': {
            classification: 'file-manager',
            component: 'FileManagerInput'
        },
        // 'quill': {
        //     classification: 'quill',
        //     component: 'QuillEditorInput'
        // },
        // 'tinymce': {
        //     classification: 'tinymce',
        //     component: 'TinymceInput'
        // }
    }
});

app.use(Siga, {});

app.use(FileManager, {
    http: useApi()
});

app.use(Menu, {
    http: useApi()
})

app.use(Make, {
    service: useApi(),
})

app.use(Table, {
    http: useApi()
})


app.directive('InfiniteScroll', vInfiniteScroll)
app.directive("expanded-item", expandedItem);
app.directive("expanded", expanded);
app.directive('popper', popper)
app.directive("tooltip", tooltip);
// app.directive("draggable",  draggable);

app.directive('focus', {
    // When the bound element is mounted into the DOM...
    mounted(el) {
        // Focus the element
        el.focus()
    }
})

import { cretaeRoutes } from './routers';

useApi().get("load/menus").then(resp => {

    app.use(cretaeRoutes(resp.data));

    app.mount("#root");

})