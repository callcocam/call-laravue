import classes from "./classes";
class Siga {

    constructor() {

        this.options = {
            classes
        }
    }

    install(app, options = {}) {

        app.config.globalProperties.$siga = this

        this.extend(options || {})


        Object.entries(
            import.meta.glob("./x/**/*.vue", {
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
            name = name.replaceAll(".-", "").toLowerCase()

            let result =name;

            console.log(result.replaceAll("--", "-"));

            app.component(result.replaceAll("--", "-"), definition.default);
        });


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

}

export default new Siga