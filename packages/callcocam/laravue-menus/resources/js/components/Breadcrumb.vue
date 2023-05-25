<!-- <template>
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 v-if="title" class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            {{ title }}
        </h2>
        <div class="hidden h-full py-1 sm:flex">
            <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
        </div>
        <div class="flex-1">
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <template v-if="items">
                    <template v-for="({ current, route, label, icon }, index) in items" :key="index">
                        <li v-if="current">{{ label }}</li>
                        <li v-else class="flex items-center space-x-2">
                            <router-link :to="route"
                                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">
                                {{ label }}
                            </router-link>
                            <x-icon :name="icon || 'fa-chevron-right'" class="h-4 w-4" />
                        </li>
                    </template>
                </template>
            </ul>
        </div>
        <div class="flex items-center justify-end space-x-2">
            <slot />
        </div>
    </div>
</template>
<script setup>

const props = defineProps({
    title: {
        type: [Boolean, String],
        default: false
    },
    items: {
        type: [Array, Boolean],
        default: false
    }
})

</script> -->
<template>
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            {{ app_name }}
        </h2>
        <div class="hidden h-full py-1 sm:flex">
            <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
        </div>
        <div class="flex-1">
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <template v-for="{ label, backRoute, index } in pages" :key="name">
                    <template v-if="backRoute">
                        <li class="flex items-center space-x-2">
                            <router-link
                                class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                                :to="backRoute">{{ label }}</router-link>
                            <x-icon name="ChevronRightIcon" icon-class="w-4.5 h-4.5" />
                        </li>
                    </template>
                    <template v-else>
                        <li>{{ label }}</li>
                    </template>
                </template>
            </ul>
        </div>
        <div class="flex items-center justify-end space-x-2">
            <slot />
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';

const app_name = ref(document.head.querySelector('title').text)

const route = useRoute();

const { name, meta } = route;

const {
    index,
    label,
    parentRoute } = meta;

const pages = []

if (parentRoute) pages.push(parentRoute)

pages.push({
    index,
    label,
})

</script>