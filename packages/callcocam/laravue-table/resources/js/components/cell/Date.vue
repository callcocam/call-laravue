<template>
    <div class="flex items-center space-x-1" :class="get(context.classes, 'element', [])">
        <x-icon name="fa-regular-clock" class="h-4 w-4"/>
        <span class="text-sm"> {{ get(context.model, context.name, null) }}</span>
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
            const data = _.get(obj, key, _default)
            const format = _.get(this.context, 'format', 'DD/MM/YYYY hh:mm:ss')
            if (data) return window.moment(data).format(format)
            return data
        }
    }

}
</script>