<template>
    <div :class="context.classes.element" :data-type="context.type">
        <input v-if="type === 'radio'" v-model="context.model" type="radio" :value="context.value" v-bind="attributes"
            @blur="context.blurHandler">
        <input v-else v-model="context.model" type="checkbox" :value="context.value" v-bind="attributes"
            @blur="context.blurHandler">
        <label v-if="usesDecorator" for="id"></label>
    </div>
</template>
<script>
import Mixin from './../../mixin'
import { has } from 'lodash'
export default {
    mixins: [
        Mixin
    ],
    computed: {
        usesDecorator() {
            return has(this.$form.options, 'useInputDecorators') ? this.$form.options.useInputDecorators : false
        },
    }

}
</script>