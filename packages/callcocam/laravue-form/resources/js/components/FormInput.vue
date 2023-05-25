<template>
    <div :class="[wrapperClass, span]">
        <component v-if="component" :is='context.component'  :context="context"
            v-bind="context.slotProps.component" />
        <component :is="context.slotComponents.errors" v-if="!context.disableErrors" :visibleErrors="hasVisibleErrors"
            :name="name" /> 
    </div>
</template>
<script>
import context from './../context'
import { createDebouncer, equals } from './../helpers'
import { useManagerErrorsStore } from '../stores/errors'
import { useManagerFormValuesStore } from '../stores/form'

import { has, includes } from 'lodash'

export default {
    name: 'FormInput',
    inheritAttrs: false,
    inject: {
        formSetter: { default: undefined },
        getFormValues: { default: () => () => ({}) },
    },
    props: {
        type: {
            type: String,
            default: 'text'
        },
        name: {
            type: [String, Boolean],
            default: true
        },
        icon: {
            type: [String, Boolean],
            default: false
        },
        scale: {
            type: [String, Number],
            default: 3
        },
        formValue: {
            default: ''
        },
        value: {
            default: false
        },
        disableErrors: {
            type: Boolean,
            default: false
        },
        options: {
            type: [Object, Array, Boolean],
            default: false
        },
        optionGroups: {
            type: [Object, Boolean],
            default: false
        },
        checked: {
            type: [String, Boolean],
            default: false
        },
        id: {
            type: [String, Boolean, Number],
            default: false
        },
        label: {
            type: [String, Boolean],
            default: false
        },
        showValue: {
            type: [String, Boolean],
            default: false
        },
        ignored: {
            type: [Boolean, String],
            default: false
        },
        help: {
            type: [String, Boolean],
            default: false
        },
        imageBehavior: {
            type: String,
            default: 'preview'
        },
        uploadUrl: {
            type: [String, Boolean],
            default: false
        },
        uploader: {
            type: [Function, Object, Boolean],
            default: false
        },
        uploadBehavior: {
            type: String,
            default: 'live'
        },
        labelPosition: {
            type: [String, Boolean],
            default: false
        },
        helpPosition: {
            type: [String, Boolean],
            default: false
        },
        preventWindowDrops: {
            type: Boolean,
            default: true
        },
        span: {
            type: [Object, Array, String],
            default: 'col-span-12'
        },
        variant: {
            type: String,
            default: 'default'
        },
        styles: {
            type: String,
            default: 'default'
        },
    },
    model: {
        prop: 'formValue',
        event: 'input'
    },
    data() {
        return {
            defaultId: this.$form.nextId(this),
            localAttributes: {},
            dSet: createDebouncer(),
            debounceDelay: this.debounce,
            localErrors: [],
            validationErrors: [],
            proxy: this.getInitialValue(),
            pendingValidation: Promise.resolve(),
            mntd: false
        }
    },

    computed: {
        ...context,
        classification() {
            const classification = this.$form.classify(this.type)
            return (classification === 'box' && this.options) ? 'group' : classification
        },
        component() {
            return (this.classification === 'group') ? 'CGroup' : this.$form.component(this.type)
        },
        wrapperClass() {
            return (has(this.context.classes, 'wrapper')) ? this.context.classes.wrapper : ''
        },
        hasVisibleErrors() {
            return useManagerErrorsStore().getErros
        }
    },
    watch: {
        '$attrs': {
            handler(value) { 
                this.updateLocalAttributes(value)
            },
            deep: true
        },

        proxy: {
            handler: function (newValue, oldValue) { 
                this.$emit('update:modelValue', newValue)
            },
            deep: true
        },
        formValue: {
            handler: function (newValue, oldValue) {
                this.$emit('update:modelValue', newValue) 
            },
            deep: true
        },
        debounce(value) {
            this.debounceDelay = value
        }
    },
    created() {
        this.applyInitialValue()
        this.applyDefaultValue()
        this.updateLocalAttributes(this.$attrs)
    },
    mounted() {
        this.mntd = true
    },
    methods: {
        getInitialValue() {
            var classification = this.$form.classify(this.type)
            classification = (classification === 'box' && this.options) ? 'group' : classification
            if (classification === 'box' && this.checked) {
                return this.value || true
            } else if (has(this.$options.props, 'value') && classification !== 'box') {
                return this.value
            } else if (has(this.$options.props, 'formValue')) {
                return this.formValue
            } else if (classification === 'group') {
                // Set the value of an empty group
                return Object.defineProperty(this.type === 'box' ? [{}] : [], '__init', { value: true })
            }
            return ''
        },
        applyInitialValue() {
            if (
                !equals(this.context.model, this.proxy) &&
                (this.classification !== 'box' || has(this.$options.props, 'options'))
            ) {
                this.context.model = this.proxy
                this.$emit('input', this.proxy)
            }
        },
        applyDefaultValue() {
            const isSelect = this.type === 'select'
            const isPlaceholder = has(this.context, 'placeholder')
            if (
                isSelect &&
                !isPlaceholder &&
                isEmpty(this.proxy) &&
                !this.isVmodeled &&
                this.value === false &&
                this.isOptions()
            ) {
                if (!has(this.$attrs, 'multiple')) {
                    this.context.model = this.context.options[0].value
                } else {
                    this.context.model = []
                }
            }
        },
        updateLocalAttributes(value) {
            if (!equals(value, this.localAttributes)) {
                this.localAttributes = value
            }
        },
        performValidation() {
            return this.pendingValidation
        },
        hasValidationErrors() { return useManagerErrorsStore().getErros },
        isOptions() {
            if (!this.optionGroups && !this.options) return false
            if (!this.options) {
                return Object.keys(this.optionGroups).length && includes(['checkbox', 'radio'], this.type)
            }
            if (!this.optionGroups) {
                return (Object.keys(this.options).length) && includes(['checkbox', 'radio'], this.type)
            }
            return (Object.keys(this.optionGroups).length || Object.keys(this.options).length) && includes(['checkbox', 'radio'], this.type)
        }
    }

}
</script>