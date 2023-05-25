<template>
    <div class="sidebar-panel">
        <div class="flex h-full grow flex-col bg-white pl-[var(--main-sidebar-width)] dark:bg-navy-750">
            <!-- Sidebar Panel Header -->
            <div class="flex h-18 w-full items-center justify-between pl-4 pr-1">
                <p class="text-base tracking-wider text-slate-800 dark:text-navy-100">
                    Titulo do menu
                </p>
                <button @click="toogleSidaber()"
                    class="btn h-7 w-7 rounded-full p-0 text-primary hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-accent-light/80 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 xl:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>
            <!-- Sidebar Panel Body -->
            <div ref="parentNode" class="h-[calc(100%-4.5rem)] overflow-hidden pb-6">
                <template v-if="getItems">
                    <simplebar :style="{ overflowY: 'auto' }">
                        <template v-for="(items, index) in getItems" :key="index">
                            <div v-if="index > 0" class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>
                            <ul class="flex flex-1 flex-col px-4 font-inter">
                                <template v-for="(item, i) in items" :key="i">
                                    <template v-if="item.hasOwnProperty('submenu')">
                                        <li>
                                            <button v-expanded-item="{ expandedItem: i, isSpand: isExpanded(i) }"
                                                type="button" @click="() => setActive(i)"
                                                :class="activeClass(i, 'text-slate-800 font-semibold dark:text-navy-50', 'text-slate-600 dark:text-navy-200')"
                                                class="w-full flex items-center justify-between py-2 text-xs+ tracking-wide  outline-none transition-[color,padding-left] duration-300 ease-in-out hover:text-slate-800  dark:hover:text-navy-50">
                                                <span> {{ item.title }}</span>
                                                <m-icon name="fa-chevron-right"
                                                    :class="activeClass(i, 'h-4 w-4 text-slate-400 transition-transform ease-in-out rotate-90', 'h-4 w-4 text-slate-400 transition-transform ease-in-out')" />
                                            </button>
                                            <ul :ref="i" class="transition-all duration-500 ease-in-out overflow-hidden">
                                                <template v-for="(submenu, indexSubmenu) in item.submenu"
                                                    :key="indexSubmenu">
                                                    <li class="flex w-full" v-if="hasRoute(submenu.route_name.name)">
                                                        <router-link :to="submenu.route_name"
                                                            active-class="text-primary dark:text-accent-light font-medium"
                                                            inactive-class="text-slate-600 hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50"
                                                            class="flex items-center justify-between p-2 text-xs+ tracking-wide
                                                                             outline-none transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                                                            {{ submenu.title }}
                                                        </router-link>
                                                    </li>
                                                </template>
                                            </ul>
                                        </li>
                                    </template>
                                    <template v-else>
                                        <li v-if="hasRoute(item.route_name.name)">
                                            <router-link :to="item.route_name"
                                                class="flex text-xs+ py-2  tracking-wide outline-none transition-colors duration-300 ease-in-out"
                                                active-class="text-primary dark:text-accent-light font-medium"
                                                inactive-class="text-slate-600  hover:text-slate-800 dark:text-navy-200 dark:hover:text-navy-50">
                                                {{ item.title }}
                                            </router-link>
                                        </li>
                                    </template>
                                </template>
                            </ul>
                        </template>
                    </simplebar>
                </template>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, computed } from 'vue';
import simplebar from 'simplebar-vue';
import 'simplebar/dist/simplebar.min.css';
import { useManagerMemuStore } from '@laravue-menus/stores/menus';
import { useManagerThemeStore } from '@laravue-menus/stores/theme';

import { useRouter } from 'vue-router';

const router = useRouter()

const { hasRoute } = router

const isSidebarExpanded = useManagerThemeStore()

const expanded = ref()

const getItems = computed(() => useManagerMemuStore().items)

const toogleSidaber = () => [
    isSidebarExpanded.toogleSidaber()
]
const setActive = (val) => {
    if (expanded.value == val) {
        expanded.value = null
    } else {
        expanded.value = val
    }
}

const activeClass = (val, activeClass, inactiveClass) => {
    return val == expanded.value ? activeClass : inactiveClass
}

const isExpanded = (val) => {
    return val == expanded.value
}


</script>