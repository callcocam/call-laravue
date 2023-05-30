<template>
    <CLabelslot :context="context">
        <div :class="context.classes.element" :data-type="context.type">
            <template v-if="options">
                <template v-for="(option, index) in options" :key="index">
                    <label class="inline-flex items-center space-x-2 ml-2" :for="option.id">
                        <template v-if="option.hasOwnProperty('value')">
                            <input v-model="context.model" :type="context.type" :value="option.value" :id="option.hasOwnProperty('id') ? option.id : index"
                                @blur="context.blurHandler" />
                        </template>
                        <template v-else>
                            <input v-model="context.model" :type="context.type" :value="index" :id="option.hasOwnProperty('id') ? option.id : index"
                                @blur="context.blurHandler" />
                        </template>
                        <span v-if="option.hasOwnProperty('label')" v-text="option.label"></span>
                        <span v-else v-text="option"></span>
                    </label>
                    <template v-if="option.hasOwnProperty('id')">
                        <label v-if="usesDecorator" :for="option.id"></label>
                    </template>
                    <template v-else>
                        <label v-if="usesDecorator" :for="index"></label>
                    </template>
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