<template>
    <x-preloader />
    <m-main />
    <m-headers-main />
    <!-- <x-header />
    <x-searchbar />
    <x-right /> -->
    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <router-view :key="$route.fullPath" />
        <!-- <router-view v-slot="{ Component }">
            <transition name="fade">
                <component :is="Component" />
            </transition>
        </router-view> -->
    </main>
</template>
<script>
import { useManagerLoadingStore } from "@/stores/loading";
import { useManagerMemuStore } from '@laravue-menus/stores/menus';
import { useRouter } from "vue-router";
export default {
    setup() {
        const router = useRouter()
        router.beforeEach((to, from, next) => {
            useManagerLoadingStore().setLoading(true)
            // console.log('beforeEach')
            next()
        })
        router.afterEach((to, from, failure) => {
            useManagerLoadingStore().setLoading(false)
            useManagerMemuStore().setHiddeSidebarExpanded()

        })
        return {}
    }
}


</script>