<template>
    <x-preloader/>
    <m-main  v-if="!$route.meta.hasOwnProperty('fileManager')"/>
    <m-headers-main  v-if="!$route.meta.hasOwnProperty('fileManager')"/>
    <main class="main-content w-full pb-8" :class="{'px-[var(--margin-x)]':!$route.meta.hasOwnProperty('fileManager')}">
        <router-view :key="$route.fullPath" />
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