import { defineStore } from 'pinia'
export const useManagerMakeElementStore = defineStore('make-element', {
    state: () => ({ formValue: {}, showEdit: false, showDelete: false }),
    getters: {
        getFormValue: (state) => state.formValue,
        getShowEdit: (state) => state.showEdit,
        getShowDelete: (state) => state.showDelete,
    },
    actions: {
        setFormValue(formValue) {
            this.formValue = formValue
        }, 
        setShowEdit(showEdit) {
            this.showEdit = showEdit
        }, 
        setShowDelete(showDelete) {
            this.showDelete = showDelete
        },
    },
})