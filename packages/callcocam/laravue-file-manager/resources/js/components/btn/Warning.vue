<template>
    <button type="button" v-bind="$attrs" :class="{ 'rounded-full': rounded }"
        class="btn bg-warning font-medium text-white space-x-1 hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90">
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