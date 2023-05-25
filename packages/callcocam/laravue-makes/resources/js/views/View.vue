<template>
    <m-breadcrumb  />
    <x-main v-if="loading" :make="form" />
</template>
<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useApi } from "@/api/useAPI"
import { useRoute } from 'vue-router';
const loading = ref(false)
const route = useRoute()
const { params } = route
let form = reactive({})
 
onMounted(async () => {
    const { data } = await useApi().get(('makes/').concat(params.id))

    form = Object.assign(form, data)

    loading.value = true
})

</script>