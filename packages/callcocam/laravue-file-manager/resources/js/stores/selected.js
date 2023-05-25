import { defineStore } from 'pinia'
export const useManagerSelectedStore = defineStore('selected', {
    state: () => ({ selected: [], directory:{}}),
    getters: {
        getSelected: (state) => state.selected,
        getDirectory: (state) => state.directory,
    },
    actions: {
        setDirectory(directory) {
            this.directory = directory
        },
        selectedFiles(file) {
            this.selected.push(file)
        },
        clearSelected(id=null) {
            if(id){
                this.selected.splice(this.selected.findIndex(v => v === id), 1);
            }
            else{
                this.selected =[]
            }
        },
    },
})
