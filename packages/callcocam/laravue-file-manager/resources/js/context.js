import Services from "./services"

export default {
    context() {
        return defineModel.call(this, {
            blurHandler: blurHandler.bind(this),
            http: this.$fm.getHttp(),
            services: new Services(this.$fm.getHttp()),
            uploadUrl: this.mergedUploadUrl,
            uploader: this.uploader || this.$fm.getUploader(),
            rootEmit: this.$emit.bind(this)
        })
    },
    mergedUploadUrl
}


function blurHandler() {
    this.$nextTick(() => this.$emit('blur-context', this.context))
}

function mergedUploadUrl() {
    return this.uploadUrl || this.$form.getUploadUrl()
}


function isVmodeled() {
    return !!(this.$options.props.hasOwnProperty('formValue') &&
        this._events &&
        Array.isArray(this._events.input) &&
        this._events.input.length)
}

function defineModel(context) {
    return Object.defineProperty(context, 'model', {
        get: modelGetter.bind(this),
        set: (value) => {
            return modelSetter.call(this, value)
        },
        enumerable: true
    })
}


function modelGetter() {
    const model = 'proxy'
    if (!this[model] && this[model] !== 0) {
        return ''
    }
    return this[model]
}


function modelSetter(value) {
    this.$emit('input', value)
}