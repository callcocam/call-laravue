<template>
    <m-breadcrumb   />
    <CFormData name="Create new app" endpoint="makes" :schema="schema" />
</template>
<script setup>
import { reactive, ref } from 'vue';


const schema = ref([])
 
</script>