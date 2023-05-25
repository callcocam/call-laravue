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
                <button
                    class="btn min-w-[7rem] border border-slate-300 font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                    Preview
                </button>
                <button
                    class="btn min-w-[7rem] bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                    Save
                </button>
            </div>
        </div>
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
                <tbody v-if="posts.data">
                    <tr v-for="(item, index) in posts.data" :key="index" class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                        <td class=" px-4 py-3 sm:px-5">{{ item.name }}</td>
                        <td class=" px-4 py-3 sm:px-5">{{ item.content }}</td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            {{ item.filemanager.path }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                            <router-link :to="{name:'post', params:{id:item.id}}">
                            Edit
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import { useApi } from "@/api/useAPI"

const posts = ref({})
onMounted(async () => {
    const { data } = await useApi().get('posts')
    posts.value = data
})
</script>