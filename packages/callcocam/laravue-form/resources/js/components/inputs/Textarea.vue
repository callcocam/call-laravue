<template>
    <div :class="context.classes.element"  class="space-y-1" :data-type="context.type">
        <CLabelslot :context="context">
            <textarea v-model="context.model" v-bind="attributes" @blur="context.blurHandler" />
            <slot />
        </CLabelslot>
    </div>
</template>
<script>
import Mixin from './../../mixin'
export default {
    mixins: [
        Mixin
    ]

}
</script>