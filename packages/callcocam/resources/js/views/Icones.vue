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
                    Icons
                </h2>
            </div>
            <div class="flex justify-center space-x-2">

            </div>
        </div>
        <div class="card p-5 border rounded-md">
            <div class="grid grid-cols-6 gap-2 p-5">
                <template v-for="(item, name) in Fa" :key="name+'-outline'">
                    <div class="flex flex-col items-center p-2 space-y-1 border rounded-md dark:bg-slate-700">
                        <v-icon :name="item.name" scale="2" />
                        <p class="text-xs text-gray-600 dark:text-gray-200"> {{ item.name }}</p>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, reactive } from 'vue'

import * as FaIcons from "oh-vue-icons/icons/fa";

const Fa = Object.values({ ...FaIcons });
</script>
