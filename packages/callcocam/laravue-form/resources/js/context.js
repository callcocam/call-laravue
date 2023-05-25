import { camelCase, has, includes } from "lodash"
import { arrayify, equals, extractAttributes, isEmpty } from "./helpers"
import { classProps } from './classes'


export default {
    context() {
        return defineModel.call(this, {
            attributes: this.elementAttributes,
            blurHandler: blurHandler.bind(this),
            component: this.component, 
            type: this.type,
            icon: this.icon,
            scale: this.scale,
            name: this.nameOrFallback,
            id: this.id || this.defaultId,
            hasLabel: (this.label && this.classification !== 'button'),
            ignored: has(this.$options.props, 'ignored'),
            labelPosition: this.logicalLabelPosition,
            helpPosition: this.logicalHelpPosition,
            label: this.label,
            help: this.help,
            name: this.nameOrFallback,
            slotComponents: this.slotComponents,
            performValidation: this.performValidation.bind(this),
            imageBehavior: this.imageBehavior,
            uploadUrl: this.mergedUploadUrl,
            uploader: this.uploader || this.$form.getUploader(),
            uploadBehavior: this.uploadBehavior,
            preventWindowDrops: this.preventWindowDrops,
            errors: this.explicitErrors,
            disableErrors: this.disableErrors,
            isValid: this.isValid,
            hasValidationErrors: this.hasValidationErrors.bind(this),
            classes: this.classes,
            classification: this.classification,
            debounceDelay: this.debounceDelay,
            hasGivenName: this.hasGivenName,
            validationErrors: this.validationErrors,
            value: this.value,
            rootEmit: this.$emit.bind(this),
            hasValue: this.hasValue,
            slotProps: this.slotProps,
            pseudoProps: this.pseudoProps,
            ...this.typeContext
        })
    },
    nameOrFallback,
    hasGivenName,
    mergedUploadUrl,
    typeContext,
    elementAttributes,
    logicalLabelPosition,
    logicalHelpPosition,
    slotComponents,
    classes,
    hasValue,
    slotProps,
    pseudoProps,
    isValid,


    filteredAttributes,
    explicitErrors,
    hasVisibleErrors,
    isVmodeled,
    listeners,
    typeProps
}


function pseudoProps() {
    // Remove any "class key props" from the attributes.
    return extractAttributes(this.localAttributes, classProps)
}


function typeProps() {
    return extractAttributes(this.localAttributes, this.$form.typeProps(this.type))
}

function mergedUploadUrl() {
    return this.uploadUrl || this.$form.getUploadUrl()
}

function slotComponents() {
    const fn = this.$form.slotComponent.bind(this.$form)
    return {
        addMore: fn(this.type, 'addMore'),
        buttonContent: fn(this.type, 'buttonContent'),
        errors: fn(this.type, 'errors'),
        file: fn(this.type, 'file'),
        help: fn(this.type, 'help'),
        label: fn(this.type, 'label'),
        prefix: fn(this.type, 'prefix'),
        remove: fn(this.type, 'remove'),
        repeatable: fn(this.type, 'repeatable'),
        suffix: fn(this.type, 'suffix'),
        uploadAreaMask: fn(this.type, 'uploadAreaMask')
    }
}

function slotProps() {
    const fn = this.$form.slotProps.bind(this.$form)
    return {
        label: fn(this.type, 'label', this.typeProps),
        help: fn(this.type, 'help', this.typeProps),
        errors: fn(this.type, 'errors', this.typeProps),
        repeatable: fn(this.type, 'repeatable', this.typeProps),
        addMore: fn(this.type, 'addMore', this.typeProps),
        remove: fn(this.type, 'remove', this.typeProps),
        component: fn(this.type, 'component', this.typeProps)
    }
}

function typeContext() {
    switch (this.classification) {
        case 'select':
            return {
                options: createOptionList.call(this, this.options),
                optionGroups: this.optionGroups ? map(this.optionGroups, (k, v) => createOptionList.call(this, v)) : false,
                placeholder: this.$attrs.placeholder || false
            }
        case 'slider':
            return { showValue: !!this.showValue }
        default:
            if (this.options) {
                return {
                    options: createOptionList.call(this, this.options)
                }
            }
            return {}
    }
}

function createOptionList(optionData) {
    if (!optionData) {
        return []
    }
    const options = Array.isArray(optionData) ? optionData : Object.keys(optionData).map(value => ({ label: optionData[value], value }))
    return options.map(createOption.bind(this))
}


function createOption(option) {
    // Numbers are not allowed
    if (typeof option === 'number') {
        option = String(option)
    }
    if (typeof option === 'string') {
        return { label: option, value: option, id: `${this.elementAttributes.id}_${option}` }
    }
    if (typeof option.value === 'number') {
        option.value = String(option.value)
    }
    return Object.assign({
        value: '',
        label: '',
        id: `${this.elementAttributes.id}_${option.value || option.label}`
    }, option)
}


function elementAttributes() {
    const attrs = Object.assign({}, this.filteredAttributes)
    // pass the ID prop through to the root element
    if (this.id) {
        attrs.id = this.id
    } else {
        attrs.id = this.defaultId
    }
    // pass an explicitly given name prop through to the root element
    if (this.hasGivenName) {
        attrs.name = this.name
    }

    // If there is help text, have this element be described by it.
    if (this.help && !has(attrs, 'aria-describedby')) {
        attrs['aria-describedby'] = `${attrs.id}-help`
    }

    // Ensure we dont have a class attribute unless we are actually applying classes.
    if (this.classes.input && (!Array.isArray(this.classes.input) || this.classes.input.length)) {
        attrs.class = this.classes.input
    }

    // @todo Filter out "local props" for custom inputs.

    return attrs
}


function filteredAttributes() {
    const filterKeys = Object.keys(this.pseudoProps)
        .concat(Object.keys(this.typeProps))
    return Object.keys(this.localAttributes).reduce((props, key) => {
        if (!filterKeys.includes(camelCase(key))) {
            props[key] = this.localAttributes[key]
        }
        return props
    }, {})
}


function blurHandler() {
    this.$nextTick(() => this.$emit('blur-context', this.context))
}

function listeners() {
    const { input, ...listeners } = this.$attrs
    return listeners
}

function classes() {
    return this.$form.classes({
        ...this.$props,
        ...this.pseudoProps,
        ...{
            attrs: this.filteredAttributes,
            classification: this.classification,
            hasErrors: this.hasVisibleErrors,
            hasValue: this.hasValue,
            helpPosition: this.logicalHelpPosition,
            isValid: this.isValid,
            labelPosition: this.logicalLabelPosition,
            type: this.type,
            value: this.proxy
        }
    })
}


function logicalHelpPosition() {
    if (this.helpPosition) {
        return this.helpPosition
    }
    switch (this.classification) {
        case 'group':
            return 'before'
        default:
            return 'after'
    }
}

function logicalLabelPosition() {
    if (this.labelPosition) {
        return this.labelPosition
    }
    switch (this.classification) {
        case 'box':
            return 'after'
        default:
            return 'before'
    }
}

function nameOrFallback() {
    if (this.name === true && this.classification !== 'button') {
        const id = this.id || this.elementAttributes.id.replace(/[^0-9]/g, '')
        return `${this.type}_${id}`
    }
    if (this.name === false || (this.classification === 'button' && this.name === true)) {
        return false
    }
    return this.name
}

function isValid () {
    return !this.hasErrors
  }

function explicitErrors () {
    return arrayify(this.errors)
      .concat(this.localErrors)
      .concat(arrayify(this.error))
  } 

function hasVisibleErrors() {
    return (
        (Array.isArray(this.validationErrors) && this.validationErrors.length && this.showValidationErrors) ||
        !!this.explicitErrors.length
    )
}

function hasValue() {
    const value = this.proxy
    if (
        (this.classification === 'box' && this.isGrouped) ||
        (this.classification === 'select' && has(this.filteredAttributes, 'multiple'))
    ) {
        return Array.isArray(value) ? value.some(v => v === this.value) : this.value === value
    }
    return !isEmpty(value)
}

function hasGivenName() {
    return typeof this.name !== 'boolean'
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
            if (!this.mntd || !this.debounceDelay) {
                return modelSetter.call(this, value)
            }
            this.dSet(modelSetter, [value], this.debounceDelay)
        },
        enumerable: true
    })
}


function modelGetter() {
    const model = this.isVmodeled ? 'formValue' : 'proxy'
    if (this.type === 'checkbox' && !Array.isArray(this[model]) && this.options) {
        return []
    }
    if (!this[model] && this[model] !== 0) {
        return ''
    }
    return this[model]
}


function modelSetter(value) {
    let didUpdate = false
    if (!equals(value, this.proxy, this.type === 'group')) {
        this.proxy = value
        didUpdate = true
    }
    if (!this.context.ignored && this.context.name && typeof this.formSetter === 'function') {
        this.formSetter(this.context.name, value)
    }
    if (didUpdate) {
        this.$emit('input', value)
    }
}