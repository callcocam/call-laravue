<template>
    <button type="button" v-bind="$attrs" :class="{ 'rounded-full': rounded }"
        class="btn bg-info font-medium text-white space-x-1 hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90">
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