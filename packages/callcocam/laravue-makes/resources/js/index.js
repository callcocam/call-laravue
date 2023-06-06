import { isPlainObject } from "lodash";

// import ElementPlus from 'element-plus';
// import 'element-plus/theme-chalk/index.css';

import {
    VueDraggableNext
} from "vue-draggable-next";


import DraggableWarp from "./components/form/DraggableWarp.vue";
// import OptionInput from "./components/form/OptionInput.vue";
// import UploadWarp from "./components/form/elementWarp/UploadWarp.vue";

import ptBr from 'element-plus/es/locale/lang/pt-br';


import hljs from 'highlight.js';


import Main from './components/Main.vue'
class Make {

    constructor() {

        this.options = {
            service: null
        }
    }

    install(app, options = {}) {

        app.config.globalProperties.$make = this

        this.extend(options || {})


        Object.entries(
            import.meta.glob("./components/m/**/*.vue", {
                eager: true,
            })
        ).forEach(([path, definition]) => {
            const component = path.replaceAll("./components/", "");

            const re = /\/\s(\w+)/;
            let name = component
                .replaceAll("/", "-")
                .replace(/\.\w+$/, "");

            const regex = /[A-Z]/g;

            const arrays = path.match(regex);

            arrays.map((v, i) => {
                name = name.replace(v, "-".concat(v));
            });
            name = name.replaceAll("--", "-").toLowerCase()
            let result = ('x-').concat(name);

            console.log(result.replaceAll("--", "-"));

            app.component(result.replaceAll("--", "-"), definition.default);
        });
        app.component('xMain', Main);


        app.component("draggable", VueDraggableNext);
        app.component("draggable-warp", DraggableWarp);

        app.provide('MAKE', this)

    }

    extend(extendWith) {
        if (typeof extendWith === 'object') {
            this.options = this.merge(this.options, extendWith)
            return this
        }
        throw new Error(`Menu.extend expects an object, was ${typeof extendWith}`)
    }

    merge(base, mergeWith, concatArrays = true) {
        var merged = {}
        for (var key in base) {
            if (mergeWith.hasOwnProperty(key)) {
                if (isPlainObject(mergeWith[key]) && isPlainObject(base[key])) {
                    merged[key] = this.merge(base[key], mergeWith[key], concatArrays)
                } else if (concatArrays && Array.isArray(base[key]) && Array.isArray(mergeWith[key])) {
                    merged[key] = base[key].concat(mergeWith[key])
                } else {
                    merged[key] = mergeWith[key]
                }
            } else {
                merged[key] = base[key]
            }
        }
        for (var prop in mergeWith) {
            if (!merged.hasOwnProperty(prop)) {
                merged[prop] = mergeWith[prop]
            }
        }
        return merged
    }

    post(path, formData, options = {}) {
        return this.options.service.post(path, formData, options)
    }

    put(path, formData, options = {}) {
        formData.append('_method', 'PUT')
        return this.options.service.post(path, formData, options)
    }

    get(path, formData, options = {}) {
        return this.options.service.get(path, formData, options)
    }

}

export default new Make