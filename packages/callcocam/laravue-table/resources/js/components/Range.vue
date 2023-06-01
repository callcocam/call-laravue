<template>
    <form @change="onChange" class="flex space-x-2">
        <div class="flex items-center">
            <label for="start" class="block">
                <span>De</span>
                <div class="relative mt-1.5">
                    <input ref="searchInput" v-model="form.start" 
                        class="form-input bg-transparent border rounded-lg px-2  transition-all duration-100 placeholder:text-slate-500 dark:placeholder:text-navy-200"
                        type="date" />
                </div>
            </label>
        </div>
        <div class="flex items-center">
            <label for="end" class="block">
                <span>Até</span>
                <div class="relative mt-1.5">
                    <input ref="searchInput" v-model="form.end"
                        class="form-input bg-transparent border rounded-lg px-2  transition-all duration-100 placeholder:text-slate-500 dark:placeholder:text-navy-200"
                        type="date" />
                </div>
            </label>
        </div>
    </form>
</template>
<script setup>
import { isEmpty } from 'lodash';
import { ref, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
const route = useRoute()
const router = useRouter()
const props = defineProps({
    name: {
        type: String,
        default: 'created_at'
    }
})


const { name } = props
const { start,end } = route.query
const form = ref({
    range:name,
    start,
    end
}
)

const onChange = () => {

    const newValue = form.value

    Object.keys(newValue).map(key => {
        if (isEmpty(newValue[key])) {
            delete newValue[key]
        }
    })
    const query = { ...route.query, ...newValue };
    router.push({ name: route.name, query })

}
</script>