import { defineStore } from 'pinia'
export const useManagerErrorsStore = defineStore('errors', {
    state: () => ({ errors: {} }),
    getters: {
        getErros: (state) => state.errors,
    },
    actions: {
        setErrors(errors) {
            this.errors = errors
        },
    },
})
