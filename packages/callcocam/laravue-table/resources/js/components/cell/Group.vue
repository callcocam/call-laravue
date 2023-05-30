<template>
    <div :class="get(context.classes, 'element', [])">
        {{ get(context.model, context.name, '') }}
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