import { capitalize, isPlainObject } from "lodash";
import elements from './elements';
import TTable from './components/Table.vue'
import TPagination from './components/Pagination.vue'
import TCell from './components/Cell.vue'
import THeader from './components/Header.vue'
import TFilters from './components/Filters.vue'
class Table {

    constructor() {

        this.options = {
            http: null,
            elements,
            slotProps: {},
            classes: {},
        }
    }

    install(app, options = {}) {

        app.config.globalProperties.$table = this

        this.extend(options || {})

        Object.entries(
            import.meta.glob("./components/cell**/*.vue", {
                eager: true,
            })
        ).forEach(([path, definition]) => {
            const component = path.replaceAll("./components/cell", "");

            const re = /\/\s(\w+)/;
            let name = component
                .replaceAll("/", " ")
                .replace(/\.\w+$/, "");

            const regex = /[A-Z]/g;

            const arrays = path.match(regex);

            arrays.map((v, i) => {
                // name = capitalize(name);
                name = name.replace(v, "".concat(v));
            });
            name = name.replaceAll(" ", "") 
            let result = ('T').concat(name);

            console.log(result );

            app.component(result.replaceAll("--", "-"), definition.default);
        });
        
        app.component('TTable', TTable)
        app.component('TPagination', TPagination)
        app.component('TCell', TCell)
        app.component('THeader', THeader)
        app.component('TFilters', TFilters)
    }

    extend(extendWith) {
        if (typeof extendWith === 'object') {
            this.options = this.merge(this.options, extendWith)
            return this
        }
        throw new Error(`Table.extend expects an object, was ${typeof extendWith}`)
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


    classify(type) {
        if (this.options.elements.hasOwnProperty(type)) {
            return this.options.elements[type].classification
        }
        console.log(type, 'unknown', this.options.elements)
        return 'unknown'
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

    post(path, formData, options = {}) {
        return this.options.http.post(path, formData, options)
    }

    put(path, formData, options = {}) {
        formData.append('_method', 'PUT')
        return this.options.http.post(path, formData, options)
    }

    get(path, formData={}, options = {}) {
        return this.options.http.get(path, formData, options)
    }

    delete(path, formData={}, options = {}) {
        return this.options.http.delete(path, formData, options)
    }
}


export default new Table