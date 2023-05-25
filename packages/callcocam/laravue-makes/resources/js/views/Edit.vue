<template>
    <m-breadcrumb   />
    <CFormData name="Create new app" endpoint="makes" :schema="schema" />
</template>
<script setup>
import { reactive, onMounted, ref } from 'vue'
import { useApi } from "@/api/useAPI"


const schema = ref([
    {
        slot: 'default',
        span: 'col-span-8',
        childrens: [
            {
                props: {
                    label: "Nome completo",
                    name: "name"
                }
            },
            {
                props: {
                    label: "Nome da rota",
                    name: "route"
                }
            },
            {
                props: {
                    label: "Nome da path",
                    name: "path"
                }
            },
            {
                props: {
                    label: "Descrição",
                    name: "description",
                    type: 'textarea'
                }
            }
        ]
    },
    {
        slot: 'right',
        span: 'col-span-4',
        childrens: [
            {
                props: {
                    label: "Data de cadastro",
                    name: "created_at",
                    type: 'date'
                }
            },
            {
                props: {
                    label: "Data de atualização",
                    name: "updated_at",
                    type: 'date'
                }
            },
            {
                props: {
                    label: "Ordering",
                    name: "order",
                    type: 'number'
                }
            },
            {
                props: {
                    label: "Status",
                    name: "status",
                    type: 'radio',
                    options: [
                        {
                            'value': 'published',
                            'label': 'Published',
                            'id': 'published',
                        },
                        {
                            'value': 'draft',
                            'label': 'Draft',
                            'id': 'draft',
                        }
                    ]
                }
            },
            {
                props: {
                    label: "SALVAR",
                    disableErrors: true,
                    type: "submit",
                    styles: "rounded",
                    variant: "primary",
                    icon: "fa-regular-save"
                }
            }
        ]
    }

]) 

</script>