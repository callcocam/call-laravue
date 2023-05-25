import { reactive, ref } from 'vue'
import { defineStore } from 'pinia'
import { has } from 'lodash'

export const useManagerFilesStore = defineStore('files', () => {

    const complete = ref(false)
    const files = ref([])
    const total = ref(0)
    const selectedFile = ref({})
    const loading = ref(false)

    const obj = ref({
        current_page: 1,
        last_page: 0,
        from: 0,
        per_page: 12,
        to: 0,
        total: 0
    })

    const setComplete = (data) => complete.value = data

    const setLoading = (data) => loading.value = data

    const setFiles = (data) => files.value = data

    const setIncrementFiles = (data) => files.value.push(...data)

    const setFile = (data) => selectedFile.value = data

    const setObj = (data) => obj.value = data

    const getObj = (key) => has(obj.value, key) ? obj.value[key] : null

    const loadStoreMoreFiles = async (services, querParams = {}) => {
        if (loading.value) {
            return;
        }
        setLoading(true)

        if (total.value && total.value > ((getObj('current_page') * getObj('per_page') - getObj('per_page')))) {
            querParams.page = (getObj('current_page') + 1)
            const { data } = await services.listServiceFiles(querParams)
            setIncrementFiles(data.data)
            delete data.data
            setObj(data)
        } else {
            setComplete(true)
        }

        setLoading(false)
    }

    const loadStoreFiles = async (services, querParams = {}) => {
        querParams.page = 1
        const { data } = await services.listServiceFiles(querParams)
        setFiles(data.data)
        delete data.data
        setObj(data)
        setLoading(false)
        const last_page = getObj('last_page')
        total.value = getObj('total')
        setComplete(false)
    }

    return { complete,loading, files, obj, selectedFile, setLoading, setFile, setFiles, setIncrementFiles, setObj, loadStoreFiles, loadStoreMoreFiles }
})
