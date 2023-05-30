<template>
    <m-breadcrumb>
        <template v-if="hasRoute(hasCreate())">
            <router-link
                class="btn min-w-[7rem] border border-slate-300 font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                :to="{ name: hasCreate() }"> New make</router-link>
        </template>
    </m-breadcrumb>
    <router-view></router-view>
    <t-table />
</template>
<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router';

const router = useRouter()

const route = useRoute()

const { hasRoute } = router


const hasCreate = () => route.name.replace('list', 'create').replace('index', 'create')

</script>