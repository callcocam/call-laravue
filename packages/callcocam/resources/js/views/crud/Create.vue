<template>
    <div>
        <CFormInput type="file-manager"    
                label="Selecione uma imagem" multiple class="form-input" />
    </div>
</template>
<script setup>
import { reactive, onMounted } from 'vue'
import { useApi } from "@/api/useAPI"
import { useRoute } from 'vue-router';
const route = useRoute()
const { params } = route
let form = reactive({})
onMounted(async () => {
    const { data } = await useApi().get('posts/create')

    form = Object.assign(form, data)
})

</script>