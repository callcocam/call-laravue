<template>
    <div class="sidebar print:hidden">
        <m-sidebar-main :menus="menus" />
        <m-sidebar-panel :items="getItems" />
    </div>
</template>
<script>
import { inject, onMounted, ref } from 'vue'
import { useApi } from '@/api/useApi'
import { useManagerMemuStore } from '@laravue-menus/stores/menus';
import { useRouter } from 'vue-router';
export default {

    computed: {
        getItems() {
            return useManagerMemuStore().items
        }
    },
    setup(props) {
        const menus = ref([])
        const menu = inject('menus')
        const router = useRouter()
        onMounted(async () => {
            const { data } = await useApi().get('menus') 
            
            const { main } = data

            menus.value = main

        })
        return { menus }
    }
}
</script>