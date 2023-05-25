<template>
    <ul v-if="visibleErrors && Object.keys(visibleErrors).length" :class="outerClass">
        <template v-for="(error, i) in visibleErrors">
            <li v-if="i === name" :key="error" :class="itemClass" :role="role" :aria-live="ariaLive" v-text="error[0]" />
        </template>
    </ul>
</template>
  
<script>
export default {
    props: {
        visibleErrors: {
            type: [Array, Object],
            required: true
        },
        itemClass: {
            type: [String, Array, Object, Boolean],
            default: false
        },
        outerClass: {
            type: [String, Array, Object, Boolean],
            default: false
        },
        role: {
            type: [String],
            default: 'status'
        },
        ariaLive: {
            type: [String, Boolean],
            default: 'polite'
        },
        type: {
            type: String,
            default: 'form'
        },
        name: {
            type: [String, Boolean],
            default: false
        }
    }
}
</script>