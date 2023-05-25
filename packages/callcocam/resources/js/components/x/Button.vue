<template>
    <button :class="[rounded, buttonStyle()]" v-bind="$attrs">
        <x-icon v-if="icon" :name="icon" class="h-5 w-5" />
        <slot />
    </button>
</template>
<script setup>
import { find, has } from 'lodash';
import classes from '../classes';
const props = defineProps({
    styles: {
        type: String,
        default: 'default'
    },
    variant: {
        type: String,
        default: 'primary'
    },
    rounded: {
        type: [Boolean, String],
        default: 'rounded-md'
    },
    icon: {
        type: [Boolean, String],
        default: false
    }
})
const buttonStyle = () => {
    const style = find(classes.button, c => props.styles)
    if (has(style, props.variant)) {
        return style[props.variant]
    }
    return []
}

</script>