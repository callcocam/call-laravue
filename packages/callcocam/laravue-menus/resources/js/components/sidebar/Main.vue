<template>
      <div class="main-sidebar z-40">
        <div
            class="flex h-full w-full flex-col items-center border-r border-slate-150 bg-white dark:border-navy-700 dark:bg-navy-800">
            <div class="flex pt-4">
                <a href="/admin">
                    <img class="h-11 w-11 transition-transform duration-500 ease-in-out hover:rotate-[360deg]"
                        v-if="!isDarkModeEnabled" src="/images/app-logo.svg" alt="Logo">
                    <img class="h-11 w-11 transition-transform duration-500 ease-in-out hover:rotate-[360deg]"
                        v-if="isDarkModeEnabled" src="/images/app-logo-white.svg" alt="Logo">
                </a>
            </div>
            <div class="is-scrollbar-hidden flex grow flex-col space-y-4 overflow-y-auto pt-6">
                <template v-if="menus">
                    <template v-for="menu in menus" :key="menu.title">
                        <template v-if="menu.hasOwnProperty('items')">
                            <m-sidebar-navigation-btn :menu="menu" :items="menu.items"
                                v-tooltip.placement.right="menu.title">
                                <m-icon :name="menu.icon" class="h-7 w-7" />
                            </m-sidebar-navigation-btn>
                        </template>
                        <template v-else>
                            <m-sidebar-navigation-link :to="menu.route_name" v-tooltip.placement.right="menu.title">
                                <v-icon :name="menu.icon"  class="h-7 w-7"/>
                            </m-sidebar-navigation-link>
                        </template>
                    </template>
                </template>

            </div>
            <div class="flex flex-col items-center space-y-3 py-3">



            </div>
        </div>
    </div>
</template>
<script>
import { useManagerThemeStore } from "@laravue-menus/stores/theme"
import { computed } from "vue";
export default {
    props: {
        menus: {
            type: [Boolean, Object],
            required: true,
            default: false
        }
    },
    setup(props) {

        const isDarkModeEnabled = computed(() => useManagerThemeStore().isDarkModeEnabled)

        return {
            isDarkModeEnabled
        }
    }
}
</script>