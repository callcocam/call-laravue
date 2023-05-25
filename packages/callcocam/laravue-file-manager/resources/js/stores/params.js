import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useManagerParamsStore = defineStore('params', () => {

    const params = ref({type:'file'})

    const setParams = (data) => {
        params.value = Object.assign({}, params.value, data)
    }

    const hasParam = (data) => params.value.hasOwnProperty(data)

    const resetParam = (data) => { delete params.value[data] }

    const resetParams = (data) => params.value = data

    return { params, hasParam, setParams, resetParams, resetParam }
})
