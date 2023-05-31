<template>
    <div :class="get(context.classes, 'element', ['avatar flex'])">
        <template v-if="context.alias">
            <img class="rounded-full" :src="get(context.model, context.alias.concat('.link_url'), 'filemanager.link_url')" alt="">
        </template>
        <template v-else>
            <img class="rounded-full" :src="get(context.model,  'filemanager.link_url')" alt="">
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