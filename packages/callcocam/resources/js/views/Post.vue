<template>
    <div>
        <div class="flex flex-col items-center justify-between space-y-4 p-5 sm:flex-row sm:space-y-0 lg:py-6">
            <div class="flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h2 class="text-xl font-medium text-slate-700 line-clamp-1 dark:text-navy-50">
                    New Post
                </h2>
            </div>
            <div class="flex justify-center space-x-2">
                <router-link :to="{name:'posts'}"
                    class="btn min-w-[7rem] border border-slate-300 font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                    Preview
                </router-link>
                <button
                    class="btn min-w-[7rem] bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                    Save
                </button>
            </div>
        </div>
        <template v-if="Object.keys(form).length">
            <CFormData :formValue="form" class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
                <div class="col-span-12 lg:col-span-8">
                    <div class="card p-5">
                        <div class="space-y-5">
                            <CFormInput name="name" :value="form.name" label="Nome completo" v-model="form.name"
                                class="form-input" />
                            <CFormInput type="textarea" v-model="form.content" label="Descrição" :value="form.content"
                                class="form-textarea" />
                            <CFormInput type="date" :value="form.created_at" label="Data de nascimento"
                                v-model="form.created_at" class="form-input" />
                            <CFormInput type="submit" label="SALVAR" class="btn" />
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-4">
                    <div class="card p-5">
                        <!-- {{ form }} -->
                        <CFormInput type="file-manager" :value="form.file_manager_id" v-model="form.file_manager_id"
                            label="Selecione uma imagem" multiple class="form-input" />
                    </div>
                </div>
            </CFormData>
        </template>
    </div>
</template>
<script setup>
import { reactive, onMounted } from 'vue'
import { useApi } from "@/api/useAPI"
import { useRoute } from 'vue-router';
const route = useRoute()
const { params } = route
let form = reactive({ })
onMounted(async () => {
    const { data } = await useApi().get(('posts/').concat(params.id))

    form = Object.assign(form, data)
})

</script>