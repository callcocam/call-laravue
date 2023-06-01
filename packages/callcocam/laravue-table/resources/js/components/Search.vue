<template>
    <input ref="searchInput" v-model="searchValue"
        class="form-input bg-transparent border rounded-lg px-2  transition-all duration-100 placeholder:text-slate-500 dark:placeholder:text-navy-200"
        v-bind="$attrs" />
</template>
<script setup>
import { ref, customRef, watch, nextTick } from 'vue'
import { useRoute, useRouter } from 'vue-router'
const route = useRoute()
const router = useRouter()
const props = defineProps({
    icon: {
        type: [Boolean, String],
        default: false
    },
    name: {
        type: String,
        default: 'search'
    }
})
const searchInput = ref('searchInput')
const { name } = props
const useDebouncedRef = (value, delay = 500) => {
    let timeout
    return customRef((track, trigger) => {
        return {
            get() {
                track()
                return value
            },
            set(newValue) {
                clearTimeout(timeout)
                timeout = setTimeout(() => {
                    value = newValue
                    trigger()
                }, delay)
            }
        }
    })
}
const searchValue = useDebouncedRef(route.query[name] || '')


watch(
    () => searchValue,
    (newValue, oldValue) => {
        if (newValue.value) {
            const search = newValue.value;
            const query = { ...route.query, [name]: search, page };
            delete query?.page
            router.push({ name: route.name, query })
        }
        else {
            const query = { ...route.query, page };
            delete query[name]
            router.push({ name: route.name, query })

        }

    },
    { deep: true }
)
</script>