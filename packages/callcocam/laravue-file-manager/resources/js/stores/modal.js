import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useManagerModalStore = defineStore('modal', () => {

    const showModal = ref(false)

    function setShowModal() {
        showModal.value = !showModal.value
    }

    function closeShowModal() {
        showModal.value = false
    }

    return { showModal, setShowModal, closeShowModal}
})
