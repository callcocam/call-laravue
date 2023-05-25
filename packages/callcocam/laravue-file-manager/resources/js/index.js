import { camelCase, capitalize, isPlainObject, lowerCase } from "lodash";
import Services from "./services"
import fauxUploader from "./faux-uploader";
import Upload from "./upload";
class FileManager {

    constructor() {
        this.options = {
            baseURL: false,
            http: null,
            uploader: fauxUploader,
            uploadUrl: false,
            fileUrlKey: 'url',
        }
    }

    install(app, options = {}) {

        app.config.globalProperties.$fm = this

        this.extend(options || {})

        app.provide('fm', this)
        const http = new Services(this.getHttp())
        app.provide('APIHttp', http)
        app.config.globalProperties.$APIHttp = http

        Object.entries(
            import.meta.glob("./components/**/*.vue", {
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
            let result = ('f-').concat(name);

            // console.log(result.replaceAll("--", "-"));

            app.component(result.replaceAll("--", "-"), definition.default);
        });


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

    getHttp(endpoint = 'api') {

        return this.options.http;
    }


    //############# UPLOAD ############

    getUploader() {
        return this.options.uploader || this.getHttp()
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

}

export default new FileManager