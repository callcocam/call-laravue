<template>
    <button @click="(el) => {
        setMenuItems(items, menu)
    }" :class="isActive(menu, activeMenu)">
        <slot />
    </button>
</template>
<script>
import { computed } from "vue";
import { useManagerMemuStore } from '@laravue-menus/stores/menus';

export default {
    props: {
        items: {
            type: Object,
            default: {}
        },
        menu: {
            type: Object,
            default: {}
        },
        defaultClass: {
            type: String,
            default: "flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200"
        },
        activeClass: {
            type: String,
            default: "text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 bg-primary/10 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
        },
        inactiveClass: {
            type: String,
            default: "hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
        }
    },
    setup(props) {

        const { defaultClass, activeClass, inactiveClass } = props

        const menuStore = useManagerMemuStore()

        const activeMenu = computed(() => useManagerMemuStore().currentMenu)

        const setMenuItems = (items, menu) => {
            menuStore.setCurrentMenu(menu)
            menuStore.setMenuItems(items)
            menuStore.setIsSidebar(true)

        }

        const isActive = (active, activeMenu) => {

            if (activeMenu) {
                if (active.title == activeMenu.title) return [defaultClass, inactiveClass, activeClass]
            }

            return [defaultClass, inactiveClass]
        }

        return {
            setMenuItems, isActive, activeMenu
        }
    }
}



</script>