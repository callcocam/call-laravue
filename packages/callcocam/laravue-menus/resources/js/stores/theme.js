import { defineStore } from 'pinia'
export const useManagerThemeStore = defineStore('global', {
    state: () => ({ isDarkModeEnabled: localStorage.getItem('_x_darkMode_on') }),
    getters: {
        getIsDarkModeEnabled: (state) => state.isDarkModeEnabled,
    },
    actions: {
        setIsDarkModeEnabled(isDarkModeEnabled) {
            this.isDarkModeEnabled = isDarkModeEnabled
        },
    },
})
