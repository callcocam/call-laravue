<template>
    <div>
        <button type="button" @click="onClick">Emit</button>
    </div>
</template>
<script>
export default {
    emits: ['selected'],
    methods: {
        onClick() { this.$emit('selected', 'selected') }
    }
}
</script>