import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useManagerFiltersStore = defineStore('filters', () => {
    
    const filters = ref([])

    const setFilters = (data)=> filters.value = data


    return { filters, setFilters}
})
