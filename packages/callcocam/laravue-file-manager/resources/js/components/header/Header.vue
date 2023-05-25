<template>
    <nav class="fm-header before:bg-white dark:before:bg-navy-750 print:hidden">
        <div class="fm-header-container relative flex w-full bg-white dark:bg-navy-750 print:hidden">
            <div class="flex w-full items-center justify-between">
                <div class="h-7 w-7">
                    <button
                        class="menu-toggle ml-0.5 flex h-7 w-7 flex-col justify-center space-y-1.5 text-primary outline-none focus:outline-none dark:text-accent-light/80"
                        :class="{ 'active': isSidebarExpanded }" @click="toogle(!isSidebarExpanded)">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <f-header-search :context="context" />
            </div>
        </div>
    </nav>
</template>
<script setup>
import { computed } from 'vue'
import { useManagerGlogalStore } from "@file-manager/stores/global"
const global = useManagerGlogalStore()
const isSidebarExpanded = computed(() => global.isSidebarExpanded)

const props = defineProps({
    context: {
        type: Object,
        default: {}
    }
})

const toogle = (isSidebarExpanded) => {
    global.setIsSidebarExpanded(isSidebarExpanded)
}
</script>