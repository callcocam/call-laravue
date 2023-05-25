<template>
    <CLabelslot :context="context">
        <div :class="context.classes.element" :data-type="context.type">
            <template v-if="options">
                <template v-for="(option, index) in options" :key="index">
                    <label class="inline-flex items-center space-x-2 ml-2" :for="option.id">
                        <input v-model="context.model" :type="context.type" :value="option.value" :id="option.id"
                            @blur="context.blurHandler" />
                        <span v-if="option.label" v-text="option.label"></span>
                    </label>
                    <label v-if="usesDecorator" :for="option.id"></label>
                </template>
            </template>
        </div>
        <slot />
    </CLabelslot>
</template>
<script>
import { has } from 'lodash'
export default {
    props: {
        context: {
            type: Object,
            required: true
        }
    },
    computed: {
        options() {
            return this.context.options || []
        },
        hasLabel() {
            return this.context.hasLabel
        },
        attributes() {
            return this.context.attributes
        },
        usesDecorator() {
            return has(this.$form.options, 'useInputDecorators') ? this.$form.options.useInputDecorators : false
        },
    }

}
</script>