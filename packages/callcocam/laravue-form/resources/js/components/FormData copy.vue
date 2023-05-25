<template>
    <form @submit.prevent="formSubmitted" class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6" v-bind="$attrs">
        <template v-if="leftColumn">
            <div :class="{
                'lg:col-span-4': leftColumn,
            }" class="col-span-12">
                <div class="card space-y-4 p-2 sm:p-3">
                    <slot name="left"></slot>
                </div>
            </div>
        </template>
        <div class="col-span-12" :class="centerColumn">
            <div class="card">
                <div v-if="name" class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                    <div class="flex items-center space-x-2">
                        <div v-if="icon"
                            class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                            <x-icon :name="icon" />
                        </div>
                        <h2 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                            {{ name }}
                        </h2>
                    </div>
                </div>
                <div class="space-y-4 p-4 sm:p-5">
                    <slot />
                </div>
            </div>
        </div>
        <template v-if="rightColumn">
            <div :class="{
                'lg:col-span-4': rightColumn,
            }" class="col-span-12">
                <div class="card space-y-4 p-2 sm:p-5">
                    <slot name="right"></slot>
                </div>
            </div>
        </template>
    </form>
</template>
<script>
import { find, get, has, map } from 'lodash';
import Submission from '../Submission';
import { useManagerFormValuesStore } from '../stores/form'
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
            default: () => ({})
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
            form: {},
            hasFailedSubmit: false
        }
    },
    created() {

        this.get()
    },
    methods: {
        async get() {

            const { params } = this.$route

            if (this.isLoading) {

                return undefined

            }

            this.isLoading = true

            try {

                const { data } = await this.$form.get(this.endpoint.concat('/').concat(params.id), {})
                useManagerFormValuesStore().setFormValue(data)
                this.applyInitialValues(data)

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
        applyInitialValues(data) {


            if (has(this.$slots, 'left')) {
                this.loadSlots(this.$slots.left(), data, 'left')
            }
            this.loadSlots(this.$slots.default(), data, 'default')
            if (has(this.$slots, 'right')) {
                this.loadSlots(this.$slots.right(), data, 'right')
            }



        },
        loadSlots(slot, data, slotName) {
            slot.map(({ children }, i) => {
                if (children) {
                    children.map((item, index) => {
                        if (has(data, item.props.name)) {
                            
                            this.$slots[slotName]()[i].children[index].props.value = 'hfgh'
                      console.log(this.$slots[slotName]()[i].children[index].props.value)
                        }
                    })
                }
            })


        },
        applyInitialValue(name, val) {


            // slot.map(({ children }, index) => this.applyInitialValue(children, index))


        },
        hasErrors() {
            return Object.values(this.contextObservers).some(hasErrors => hasErrors)
        },
        async formSubmitted() {
            if (this.isLoading) {
                return undefined
            }
            this.isLoading = true
            try {
                useManagerErrorsStore().setErrors({})
                const { data } = await this.$form.post(this.endpoint, this.formValue)
                this.$emit('success', data)
                this.isLoading = false
            } catch (error) {
                this.isLoading = false
                const { response, message } = error
                const { data } = response
                this.contextObservers = {
                    errosr: data.errors,
                    message
                }
                useManagerErrorsStore().setErrors(data.errors)
                this.$emit('error', this.contextObservers)
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