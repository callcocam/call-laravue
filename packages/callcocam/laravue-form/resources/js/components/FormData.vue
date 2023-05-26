<template>
    <form @submit.prevent="formSubmitted" class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6" v-bind="$attrs">
        <template v-if="formSchema && form && !isLoading">
            <template v-for="({ slot, childrens, span }) in formSchema" :key="slot">
                <template v-if="slot == 'left'">
                    <div :class="span" class="col-span-12">
                        <div class="card space-y-4 p-4">
                            <template v-if="children.props.hasOwnProperty('name')">
                                <CFormInput v-bind="children.props" :value="form[children.props.name]"
                                    v-model="form[children.props.name]" />
                            </template>
                            <template v-else>
                                <CFormInput v-bind="children.props" />
                            </template>
                        </div>
                    </div>
                </template>
                <template v-else-if="slot == 'right'">
                    <div :class="span" class="col-span-12">
                        <div class="card space-y-4 p-4">
                            <template v-for="(children, index) in childrens" :key="index">
                                <template v-if="children.props.hasOwnProperty('name')">
                                    <CFormInput v-bind="children.props" :value="form[children.props.name]"
                                        v-model="form[children.props.name]" />
                                </template>
                                <template v-else>
                                    <CFormInput v-bind="children.props" />
                                </template>
                            </template>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="col-span-12" :class="span">
                        <div class="card">
                            <div v-if="formLabel" class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                                <div class="flex items-center space-x-2">
                                    <div v-if="formIcon"
                                        class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                                        <x-icon :name="formIcon" />
                                    </div>
                                    <h2 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                                        {{ formLabel }}
                                    </h2>
                                </div>
                            </div>
                            <div class="gap-4 p-4 sm:p-5 grid grid-cols-12">
                                <template v-for="(children, index) in childrens" :key="index">
                                    <template v-if="children.props.hasOwnProperty('name')">
                                        <CFormInput v-bind="children.props" :value="form[children.props.name]"
                                            v-model="form[children.props.name]" />
                                    </template>
                                    <template v-else>
                                        <CFormInput v-bind="children.props" />
                                    </template>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </template>
        </template>
    </form>
</template>
<script>
import { find, get, has, map } from 'lodash';
import { useManagerErrorsStore } from '../stores/errors'
export default {
    name: 'FormData',
    inheritAttrs: false,
    model: {
        prop: 'formValue',
        event: 'input'
    },
    props: {
        name: {
            type: [String, Boolean],
            default: false
        },
        endpoint: {
            type: [String, Boolean],
            default: false
        },
        icon: {
            type: [String, Boolean],
            default: 'fa-layer-group'
        },
        formValue: {
            type: Object,
            default: {}
        },
        schema: {
            type: [Array, Boolean],
            default: false
        }
    },
    data() {
        return {
            formShouldShowErrors: false,
            isLoading: false,
            contextObservers: [],
            namedErrors: [],
            formSchema: [],
            form: {},
            formIcon: null,
            formLabel: null,
            formData: null,
            hasFailedSubmit: false
        }
    },
    created() {

        this.get()
    },
    watch: {
        form: {
            handler: function (newValue, oldValue) { },
            deep: true
        },
        formSchema: {
            handler: function (newValue, oldValue) { },
            deep: true
        },
    },
    methods: {
        async get() {

            const { params, name } = this.$route

            let endpoint = ''

            if (this.isLoading) {

                return undefined

            }

            this.isLoading = true

            try {
                if (has(params, 'id')) {
                    if (this.endpoint) {
                        endpoint = this.endpoint.concat('/').concat(params.id).concat('/edit')
                    }
                    else {
                        endpoint = name.replace('.', '/#/')
                        endpoint = endpoint.replace('#', params.id)
                    }
                    const { data } = await this.$form.get(endpoint, {})


                    this.applyInitialSchema(data)
                }
                else {
                    if (this.endpoint) {
                        endpoint = this.endpoint.concat('/create')
                    }
                    else {
                        endpoint = name.replace('.', '/')
                    }
                    const { data } = await this.$form.get(endpoint, {})

                    this.applyInitialSchema(data)
                }


                this.isLoading = false

            } catch (error) {

                this.isLoading = false

                const { response, message } = error

                if (response) {

                    const { data } = response

                }

                console.log(error)
            }
        },
        applyInitialSchema(response) {
            const { schema, label, icon, data } = response

            if (!this.icon) {
                this.formIcon = icon
            } else {
                this.formIcon = this.icon
            }

            if (!this.label) {
                this.formLabel = label
            } else {
                this.formLabel = this.label
            }

            if (schema) {
                this.formSchema = Object.assign({}, schema, this.schema)
            } else {
                this.formSchema = Object.assign({}, this.schema)
            }

            this.applyInitialValues(Object.assign(data, this.formValue))
        },
        applyInitialValues(data) {
            this.formData = new FormData()

            if (has(data, 'deleted_at')) delete data.deleted_at

            map(data, (val, name) => this.applyInitialValue(name, val))

        },
        applyInitialValue(name, val) {
            this.formData.append(name, val)
            this.form[name] = val

        },
        hasErrors() {
            return Object.values(this.contextObservers).some(hasErrors => hasErrors)
        },
        async formSubmitted() {
            if (this.isLoading) {
                return undefined
            }
            this.isLoading = true
            this.applyInitialValues(this.form)

            let endpoint = ''
            const { params, name } = this.$route
            try {
                useManagerErrorsStore().setErrors({})
                if (has(params, 'id')) {
                    if (this.endpoint) {
                        endpoint = this.endpoint.concat('/').concat(params.id)
                    }
                    else {
                        endpoint = name.replace('.edit', ('/').concat(params.id)).replace('.create', '')
                    }
                    const { data } = await this.$form.put(endpoint, this.formData)
                    this.$emit('success', data)
                }
                else {
                    const { data } = await this.$form.post(this.endpoint, this.formData)
                    this.$emit('success', data)
                }

                this.isLoading = false
            } catch (error) {
                this.isLoading = false
                const { response, message } = error

                if (response) {
                    const { data } = response
                    const { errors } = data
                    if (errors) {
                        this.contextObservers = {
                            errors: errors,
                            message
                        }
                        useManagerErrorsStore().setErrors(data.errors)
                        this.$emit('error', this.contextObservers)
                    }
                }
                console.log(error)
            }
        }
    },
    computed: {
        rightColumn() {
            return has(this.$slots, 'right')
        },
        leftColumn() {
            return has(this.$slots, 'left')
        },
        centerColumn() {
            const classes = []
            if (has(this.$slots, 'left') && has(this.$slots, 'right')) {
                classes.push(['lg:col-span-4'])
                return classes
            }
            if (has(this.$slots, 'left') || has(this.$slots, 'right')) {
                classes.push(['lg:col-span-8'])
                return classes
            }
            classes.push(['lg:col-span-8'])
            return classes
        }
    },
}
</script>