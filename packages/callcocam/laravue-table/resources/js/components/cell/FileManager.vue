<template>
    <div :class="get(context.classes, 'element', ['avatar flex'])">
       <img class="rounded-full" :src="get(context.model,   'filemanager.link_url', '')" alt="">
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