<template>
    <button type="button" v-bind="$attrs" :class="{ 'rounded-full': rounded }"
        class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent space-x-1 dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
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