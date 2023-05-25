import { defineStore } from 'pinia'
export const useManagerLoadingStore = defineStore('loading', {
    state: () => ({ loading: false }),
    getters: {
        getLoading: (state) => state.loading,
    },
    actions: {
        setLoading(loading) {
            this.loading = loading
        },
    },
})
