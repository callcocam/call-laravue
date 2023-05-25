import { ref } from 'vue'
import { defineStore } from 'pinia'
import { useManagerFiltersStore } from '@file-manager/stores/filters'

export const useManagerDirStore = defineStore('dirs', () => {


    const { setFilters } = useManagerFiltersStore()

    const dirs = ref([])

    const directory = ref({})

    const setDirs = (data) => dirs.value = data

    const setDirectory = (data) => directory.value = data

    const loadStoreDirs = async (APIHttp, params = { type: 'dir' }) => {
        setDirs([])
        const { data } = await APIHttp.listServiceFolders({ params })
        const { dirs, filters } = data
        setDirs(dirs)
        setFilters(filters)
    }

    return { dirs, directory, setDirs, setDirectory, loadStoreDirs }
})
