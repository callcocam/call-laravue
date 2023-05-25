<template>
    <m-breadcrumb  />
    {{ form  }}
</template>
<script setup>
import { reactive, onMounted } from 'vue'
import { useApi } from "@/api/useAPI"
import { useRoute } from 'vue-router';
const route = useRoute()
const { params } = route
let form = reactive({})
 
onMounted(async () => {
    const { data } = await useApi().get(('makes/').concat(params.id))

    form = Object.assign(form, data)
})

</script>