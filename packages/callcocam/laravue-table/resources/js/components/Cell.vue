<template>
    <component v-if="component" :is='component' :context="context" v-bind="context.slotProps.component" />
</template>
<script>
import context from './../context';
export default {
    props: {
        type: {
            type: String,
            default: 'text'
        },
        name: {
            type: [String, Boolean],
            default: false
        },
        model: {
            type: Object
        },
        options: {
            type: [Object, Array, Boolean],
            default: false
        },
        optionGroups: {
            type: [Object, Boolean],
            default: false
        },
    },
    data() {
        return {
            localAttributes: {},
            http: null
        }
    },
    computed: {
        ...context,
        classification() {
            const classification = this.$table.classify(this.type)
            return (classification === 'box' && this.options) ? 'group' : classification
        },
        component() {
            return (this.classification === 'group') ? 'TGroup' : this.$table.component(this.type)
        },
    }
}
</script>