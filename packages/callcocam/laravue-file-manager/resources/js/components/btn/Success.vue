<template>
    <button type="button" v-bind="$attrs" :class="{ 'rounded-full': rounded }"
        class="btn bg-success font-medium text-white space-x-1 hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90">
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