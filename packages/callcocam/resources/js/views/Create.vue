<template>
    <m-breadcrumb title="Makes create" :items="items" />
    <CFormData :formValue="form" name="Create new app" endpoint="makes">
        <div class="grid grid-cols-12 gap-4">
            <CFormInput name="name" :value="form.name" label="Nome completo" v-model="form.name"  />
            <CFormInput name="route" :value="form.route" label="Nome da rota" v-model="form.route"
                :classSpan="['md:col-span-6 col-span-12']" />
            <CFormInput name="path" :value="form.path" label="Nome da path" v-model="form.path"
                :classSpan="['md:col-span-6 col-span-12']" />
            <CFormInput name="description" type="textarea" v-model="form.description" label="Descrição" :value="form.content"
                class="form-textarea w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" />
        </div>
        <template #right>
            <div class="flex flex-col space-y-2">
                <CFormInput name="created_at" type="date" :value="form.created_at" label="Data de criação" v-model="form.created_at"
                    class="form-input" />
                <CFormInput nane="updated_at" type="date" :value="form.updated_at" label="Data de atualização" v-model="form.updated_at"
                    class="form-input" />
                <CFormInput :disableErrors="true" type="submit" label="SALVAR" styles="rounded" variant="primary" icon="fa-regular-save" />

            </div>
        </template>
    </CFormData>
</template>
<script setup>
import { reactive, ref } from 'vue';

let form = reactive({})

const items = ref([
    {
        current: false, route: { name: 'makes' }, label: 'Makes', icon: false
    },
    {
        current: true, label: 'Create new make'
    }
])
</script>