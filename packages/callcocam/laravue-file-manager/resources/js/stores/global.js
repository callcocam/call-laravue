import { defineStore } from 'pinia'
export const useManagerGlogalStore = defineStore('global-file-manager', {
    state: () => ({ isSidebarExpanded: true, isShowPopper:false}),
    getters: {
        getIsSidebarExpanded: (state) => state.isSidebarExpanded,
        getIsShowPopper: (state) => state.isShowPopper,
    },
    actions: {
        setIsSidebarExpanded(isSidebarExpanded) {
            this.isSidebarExpanded = isSidebarExpanded
        },
        setIsShowPopper(isShowPopper) {
            this.isShowPopper = isShowPopper
        },
    },
})
