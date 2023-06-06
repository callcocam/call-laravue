<template>
    <main class="flex-1">
        <m-breadcrumb />
        <!-- Page title & actions -->
        
        <template v-if="component()">
           <component :is="component()"></component>
        </template>
        <template v-else>
            <div>

                View dsgsg
            </div>
        </template>

    </main>
</template>
<script setup>
import { get } from 'lodash';
import { useRoute } from 'vue-router';



const route = useRoute() 
const component = () => get(route.meta, 'component')

</script>