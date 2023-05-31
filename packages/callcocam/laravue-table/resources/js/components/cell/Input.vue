<template>
    <div :class="get(context.classes, 'element', [])">
        <template v-if="context.alias">
            {{ get(context.model, context.alias, '') }} 
        </template>
        <template v-else>
            {{ get(context.model, context.name, '') }}
        </template>

    </div>
</template>
<script>
import Mixin from './../../mixin'
import { _ } from 'lodash';
export default {
    mixins: [
        Mixin
    ],
    methods: {
        get(obj, key, _default = {}) {
            return _.get(obj, key, _default)
        }
    }

}
</script>