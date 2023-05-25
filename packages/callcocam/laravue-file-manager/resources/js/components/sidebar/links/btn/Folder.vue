<template>
    <button v-if="previews && previews.length" @click="onClick()"
        class="btn mr-1 h-5 w-5 rounded-lg p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
        <f-icons-icon name="fa-chevron-right" class="h-4.5 w-4.5 transition-transform" :class="isExpanded && 'rotate-90'" />
    </button>

    <slot />
</template>
<script setup>
import { defineEmits, computed } from 'vue'
const props = defineProps({
    previews: {
        type: Object
    },
    isExpanded: {
        type: Boolean,
        default: false
    }
})
const isExpanded = computed(() => props.isExpanded)

const emit = defineEmits(['onExpanded'])

const onClick = () => {
    emit('onExpanded', !props.isExpanded)
}
</script>