import { defineStore } from 'pinia'
export const useManagerFormValuesStore = defineStore('form', {
    state: () => ({ formValue: {} }),
    getters: {
        getFormValue: (state) => state.formValue,
    },
    actions: {
        setFormValue(formValue) {
            this.formValue = formValue
        },
    },
})