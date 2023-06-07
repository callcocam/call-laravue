<template>
    <main class=" kanban-app w-full">
        <div class="flex items-center justify-between space-x-2 py-5 transition-all duration-[.25s] ">
            <div class="flex items-center space-x-1">
                <h3 class="text-lg font-medium text-slate-700 line-clamp-1 dark:text-navy-50">
                    Make APP
                </h3>
                <button
                    class="btn hidden h-8 w-8 rounded-full p-0 font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25 sm:inline-flex">
                    <x-icon name="fa-lock" class="h-4.5 w-4.5" />
                </button>
            </div>
            <label class="relative hidden w-full max-w-[16rem] sm:flex">
                <input
                    class="form-input peer h-8 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 text-xs+ placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="Search on boards" type="text" />
                <span
                    class="pointer-events-none absolute flex h-full w-9 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-colors duration-200"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M3.316 13.781l.73-.171-.73.171zm0-5.457l.73.171-.73-.171zm15.473 0l.73-.171-.73.171zm0 5.457l.73.171-.73-.171zm-5.008 5.008l-.171-.73.171.73zm-5.457 0l-.171.73.171-.73zm0-15.473l-.171-.73.171.73zm5.457 0l.171-.73-.171.73zM20.47 21.53a.75.75 0 101.06-1.06l-1.06 1.06zM4.046 13.61a11.198 11.198 0 010-5.115l-1.46-.342a12.698 12.698 0 000 5.8l1.46-.343zm14.013-5.115a11.196 11.196 0 010 5.115l1.46.342a12.698 12.698 0 000-5.8l-1.46.343zm-4.45 9.564a11.196 11.196 0 01-5.114 0l-.342 1.46c1.907.448 3.892.448 5.8 0l-.343-1.46zM8.496 4.046a11.198 11.198 0 015.115 0l.342-1.46a12.698 12.698 0 00-5.8 0l.343 1.46zm0 14.013a5.97 5.97 0 01-4.45-4.45l-1.46.343a7.47 7.47 0 005.568 5.568l.342-1.46zm5.457 1.46a7.47 7.47 0 005.568-5.567l-1.46-.342a5.97 5.97 0 01-4.45 4.45l.342 1.46zM13.61 4.046a5.97 5.97 0 014.45 4.45l1.46-.343a7.47 7.47 0 00-5.568-5.567l-.342 1.46zm-5.457-1.46a7.47 7.47 0 00-5.567 5.567l1.46.342a5.97 5.97 0 014.45-4.45l-.343-1.46zm8.652 15.28l3.665 3.664 1.06-1.06-3.665-3.665-1.06 1.06z" />
                    </svg>
                </span>
            </label>

            <div class="w-72 shrink-0">
                <AddBoard :make-id="route.params.id" @loadBoards="loadBoards" />
            </div>
        </div>
        <div class="flex h-[calc(100vh-8.5rem)] flex-grow flex-col">

            <template v-if="boards.length">
                <EditElement @loadBoards="loadBoards" />
                <DeleteElement @loadBoards="loadBoards" />
                <div v-draggable="{
                    animation: 200,
                    easing: 'cubic-bezier(0, 0, 0.2, 1)',
                    delay: 150,
                    delayOnTouchOnly: true,
                    draggable: '.board-draggable',
                    handle: '.board-draggable-handler',

                }"
                    class="kanban-scrollbar grid grid-cols-12 w-full items-start gap-4 overflow-x-auto overflow-y-hidden  transition-all duration-[.25s]">
                    <Board v-for="(board, index) in boards" :key="index" :board="board" :fields="fields"
                        @loadBoards="loadBoards" />
                </div>
            </template>
            <template v-else>
                <div class="flex w-full items-center h-full justify-center">
                    <img class="w-96" src="/images/illustrations/empty-board.svg" alt="No boards">
                </div>
            </template>
        </div>

    </main>
</template>
<script setup>
import { inject, onMounted, ref } from 'vue';
import Board from './Board.vue'
import AddBoard from './AddBoard.vue'
import { useRoute } from 'vue-router'
import EditElement from './EditElement.vue';
import DeleteElement from './DeleteElement.vue';
const route = useRoute()

const boards = ref([])
const fields = ref([])

const MAKEAPP = inject('MAKE')

const loadBoards = (async () => {

    const perPage = 1000
    
    boards.value = []

    const { data } = await MAKEAPP.get('make/boards', { perPage })

    boards.value = data
})

onMounted(async () => {

    await loadBoards()

    const perPage = 1000

    const { data } = await MAKEAPP.get('make/fields', { perPage })

    fields.value = data

})
</script>
