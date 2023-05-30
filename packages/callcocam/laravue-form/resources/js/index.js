import { capitalize, find, isPlainObject, lowerCase, map } from 'lodash';
import FormSlot from './slots'
import FormData from './components/FormData.vue'
import FormInput from './components/FormInput.vue'
import FormErrors from './components/FormErrors.vue'
import elements from './elements';
import mimes from './mimes';
import { useRoute } from 'vue-router';
import coreClasses, { applyClasses, applyStates } from './classes'
import Upload from './upload';
import fauxUploader from './faux-uploader';
class Form {

    constructor() {
        this.options = {
            service: null,
            elements,
            idPrefix: 'form-',
            components: [],
            slotProps: {},
            slotComponents: {
                buttonContent: 'CButtoncontentslot',
                prefix: false,
                file: 'CFileslot',
                errors: 'CFormErrors',
                suffix: false,
                uploadAreaMask: 'div'
            },
            baseClasses: b => b,
            coreClasses,
            classes: {},
            mimes,
            useInputDecorators: true,
            validationNameStrategy: false,
            uploader: fauxUploader,
            uploadUrl: false,
            fileUrlKey: 'url',
        }
        this.registry = new Map()
        this.idRegistry = {}
    }

    install(app, options = {}) {
        app.config.globalProperties.$form = this
        Object.entries(
            import.meta.glob(["./components/inputs/**/*.vue", "./components/slots/**/*.vue"], {
                eager: true,
            })
        ).forEach(([path, definition]) => {
            const component = path.replaceAll("./components/", "")
                .replaceAll("inputs/", "")
                .replaceAll("slots/", "");

            const re = /\/\s(\w+)/;
            let name = component
                .replaceAll("/", "-")
                .replace(/\.\w+$/, "");

            let result = "C".concat(capitalize(name));

            // console.log(result);

            app.component(result, definition.default);
        });
        this.extend(options || {})
        app.component('CFormSlot', FormSlot)
        app.component('CFormErrors', FormErrors)
        app.component('CFormData', FormData)
        app.component('CFormInput', FormInput)
    }
    extend(extendWith) {
        if (typeof extendWith === 'object') {
            this.options = this.merge(this.options, extendWith)
            return this
        }
        throw new Error(`Formulate.extend expects an object, was ${typeof extendWith}`)
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

    add = (n, c) => ({
        type: n,
        component: c
    })

    nextId(vm) {
        const route = useRoute()
        const path = route && route.path ? route.path : false
        const pathPrefix = path ? route.path.replace(/[/\\.\s]/g, '-') : 'global'
        if (!Object.prototype.hasOwnProperty.call(this.idRegistry, pathPrefix)) {
            this.idRegistry[pathPrefix] = 0
        }
        return `${this.options.idPrefix}${pathPrefix}-${++this.idRegistry[pathPrefix]}`
    }

    classify(type) {
        if (this.options.elements.hasOwnProperty(type)) {
            return this.options.elements[type].classification
        }
        console.log(type, 'unknown', this.options.elements)
        return 'unknown'
    }

    classes(classContext) {
        // Step 1: We get the global classes for all keys.
        const coreClasses = this.options.coreClasses(classContext)
        // Step 2: We extend those classes with a user defined baseClasses.
        const baseClasses = this.options.baseClasses(coreClasses, classContext)
        return Object.keys(baseClasses).reduce((classMap, key) => {
            // Step 3: For each key, apply any global overrides for that key.
            let classesForKey = applyClasses(baseClasses[key], this.options.classes[key], classContext)
            // Step 4: Apply any prop-level overrides for that key.
            classesForKey = applyClasses(classesForKey, classContext[`${key}Class`], classContext)
            // Step 5: Add state based classes from props.
            classesForKey = applyStates(key, classesForKey, this.options.classes, classContext)
            // Now we have our final classes, assign to the given key.
            return Object.assign(classMap, { [key]: classesForKey })
        }, {})
    }

    component(type) {
        if (this.options.elements.hasOwnProperty(type)) {
            return this.options.elements[type].component
        }
        return false
    }
    typeProps(type) {
        const extract = obj => Object.keys(obj).reduce((props, slot) => {
            return Array.isArray(obj[slot]) ? props.concat(obj[slot]) : props
        }, [])
        const props = extract(this.options.slotProps)
        return this.options.elements[type]
            ? props.concat(extract(this.options.elements[type].slotProps || {}))
            : props
    }

    slotProps(type, slot, typeProps) {
        let props = Array.isArray(this.options.slotProps[slot]) ? this.options.slotProps[slot] : []
        const def = this.options.elements[type]
        if (def && def.slotProps && Array.isArray(def.slotProps[slot])) {
            props = props.concat(def.slotProps[slot])
        }
        return props.reduce((props, prop) => Object.assign(props, { [prop]: typeProps[prop] }), {})
    }

    slotComponent(type, slot) {
        const def = this.options.elements[type]
        if (def && def.slotComponents && def.slotComponents[slot]) {
            return def.slotComponents[slot]
        }
        return this.options.slotComponents[slot]
    }

    //############# UPLOAD ############

    getUploader() {
        return this.options.uploader || false
    }

    getUploadUrl() {
        return this.options.uploadUrl || false
    }

    getFileUrlKey() {
        return this.options.fileUrlKey || 'url'
    }

    createUpload(fileList, context) {
        return new Upload(fileList, context, this.options)
    }

    createUpload(fileList, context) {
        return new Upload(fileList, context, this.options)
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

export default new Form