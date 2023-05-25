<template>
  <button type="button" v-bind="$attrs" :class="{ 'rounded-full': rounded }"
    class="btn bg-slate-150 space-x-1 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
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