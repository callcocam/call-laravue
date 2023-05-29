<template>
    <div :class="context.classes.element" :data-type="context.type">
        <CLabelslot :context="context">
            <select v-model="context.model"
            :class="context.classes.element.input"
             v-bind="attributes" @blur="context.blurHandler">
                <template v-if="options">
                            <option  v-if=" context.placeholder">{{ context.placeholder }}</option>
                    <template v-for="(option, index) in options" :key="index">
                        <template v-if="option.hasOwnProperty('value')">
                            <option :value="option.value">{{ option.label }}</option>
                        </template>
                        <template v-else>
                            <option :value="index">{{ option }}</option>
                        </template>
                    </template>
                </template>
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