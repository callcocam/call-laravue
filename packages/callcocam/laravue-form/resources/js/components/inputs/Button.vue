<template>
    <div :class="context.classes.element" :data-type="context.type">
        <button :type="type" :class="context.classes.element" v-bind="attributes">
            <slot :context="context">
                <component :is="context.slotComponents.buttonContent" :context="context" />
            </slot>
        </button>
    </div>
</template>
<script>
import Mixin from './../../mixin'
export default {
    mixins: [
        Mixin
    ],
    props: {
        disableErrors: {
            type: Boolean,
            default: true
        },
    }

}
</script>