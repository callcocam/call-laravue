<template>
    <div :class="context.classes.element" :data-type="context.type">
        <CLabelslot :context="context">
            <select v-model="context.model" v-bind="attributes" @blur="context.blurHandler">

            </select>
            <slot />
        </CLabelslot>
    </div>
</template>
<script>
import Mixin from './../../mixin'
export default {
    mixins: [
        Mixin
    ],
    computed: {
        options() {
            return this.context.options || []
        },
        optionGroups() {
            return this.context.optionGroups || []
        },
        hasLabel() {
            return this.context.hasLabel
        },
        attributes() {
            return this.context.attributes
        }
    }

}
</script>