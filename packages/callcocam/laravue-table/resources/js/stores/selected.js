import { defineStore } from 'pinia'
export const useManagerSelectedStore = defineStore('selected-table', {
    state: () => ({ selected: [] }),
    getters: {
        getSelected: (state) => state.selected,
    },
    actions: {
        selectedAll(data) {
            data.map(({ id }) => this.selected.push(id))
        },
        setSelected(id) {
            this.selected.push(id)
        },
        clearSelected(id = null) {
            if (id) {
                this.selected.splice(this.selected.findIndex(v => v === id), 1);
            }
            else {
                this.selected = []
            }
        },
    },
})