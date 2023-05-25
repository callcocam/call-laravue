<template>
  <label :id="`${context.id}_label`" class="space-y-1" :class="context.classes.label" :for="context.id">
    <span class="font-medium text-slate-600 dark:text-navy-100" v-if="context.hasLabel" v-text="context.label"></span>
    <slot />
  </label>
</template>

<script>
export default {
  props: {
    context: {
      type: Object,
      required: true
    }
  }
}
</script>
