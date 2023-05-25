<template>
   <x-icon v-if="context.icon" :name="context.icon"  class="w-5 h-5 mr-1"/>
   <span :class="`form-input-element--${context.type}--label`"
        v-text="context.value || context.label || context.name || 'Submit'" />
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