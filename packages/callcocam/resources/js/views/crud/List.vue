<template>
    <m-breadcrumb>
        <template v-if="hasRoute(hasCreate())">
            <router-link
                class="btn min-w-[7rem] border border-slate-300 font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                :to="{ name: hasCreate() }"> New make</router-link>
        </template>
    </m-breadcrumb>
    <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                    <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                        #
                    </th>
                    <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                        Name
                    </th>
                    <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                        Job
                    </th>
                    <th
                        class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                        Favorite Color
                    </th>
                </tr>
            </thead>
            <tbody v-if="makes.data">
                <tr v-for="(item, index) in makes.data" :key="index"
                    class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                    <td class=" px-4 py-3 sm:px-5"> <input type="checkbox"> </td>
                    <td class=" px-4 py-3 sm:px-5">{{ item.name }}</td>
                    <td class=" px-4 py-3 sm:px-5">{{ item.content }}</td>
                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        <template v-if="hasRoute(hasEdit())">
                        <router-link :to="{ name: hasEdit(), params: { id: item.id } }">
                            Edit
                        </router-link>
                        </template>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router';
import { useApi } from "@/api/useAPI"

const router = useRouter()

const route = useRoute()

const { hasRoute } = router

const makes = ref({})

const hasCreate = () => route.name.replace('index', 'create')
const hasEdit = () => route.name.replace('index', 'edit')
const hasApiList = () => route.name.replace('.index', '').replace('.', '/')

onMounted(async () => {
    const { data } = await useApi().get(hasApiList())
    makes.value = data
})
</script>