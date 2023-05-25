<template>
    <div :class="context.classes.element" :data-type="context.type">
        <CLabelslot :context="context">
            <input v-model="context.model" 
            :class="context.classes.element.input"
            :type="type" v-bind="attributes" @blur="context.blurHandler"/>
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