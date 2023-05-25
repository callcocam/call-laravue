<template>
    <button type="button" v-bind="$attrs" :class="{ 'rounded-full': rounded }"
        class="btn space-x-1 bg-secondary font-medium text-white hover:bg-secondary-focus focus:bg-secondary-focus active:bg-secondary-focus/90">
        <slot />
    </button>
</template>
<script setup>
const props = defineProps({
    rounded: {
        type: Boolean,
        default: false
    }
})
</script>