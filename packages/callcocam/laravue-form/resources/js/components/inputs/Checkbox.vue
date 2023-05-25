<template>
    <div class="flex items-center relative space-x-2">
        {{ context.model }}
        <input 
        v-model="context.model" 
        type="checkbox" 
        :value="context.value" 
        v-bind="attributes"
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
        }
    }

}
</script>