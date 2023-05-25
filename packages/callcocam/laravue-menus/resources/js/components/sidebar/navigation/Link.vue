<template>
    <router-link :to="to" :class="defaultClass" :activeClass="activeClass" :inactiveClass="inactiveClass">
        <slot />
    </router-link>
</template>
<script setup>

const props = defineProps({
    to: {},
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
})

const { to, defaultClass, activeClass, inactiveClass } = props
</script>