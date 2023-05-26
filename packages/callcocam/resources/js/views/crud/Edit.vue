<template>
    <main class="flex-1">
        <m-breadcrumb  />
        <CFormData name="Create new app"   />
    </main>
</template>
<script setup>
import { useRoute } from 'vue-router';

 
const route = useRoute()
</script>