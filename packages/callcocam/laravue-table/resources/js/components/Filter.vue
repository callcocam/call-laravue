<template>
    <component v-if="component" :is='component' v-bind="{ type, name, alias, model, options, optionGroups }" />
</template>
<script>
import { capitalize } from 'lodash';
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
        alias: {
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
        component() {
            let comp = ''
            switch (this.type) {
                case 'status' || 'select':
                    comp = 'SelectFilter'
                    break;
                case 'date' || 'email' || 'tel' || 'number' || 'datetime-local':
                    comp = 'TextFilter'
                    break;
                default:
                    comp = capitalize(this.type).concat('Filter')
                    break;
            }
            return comp
        },
    }
}
</script>