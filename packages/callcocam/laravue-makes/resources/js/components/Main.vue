<template>
    <div class="grid grid-cols-4 gap-2">
        <div class="col-span-4 md:col-span-1">
            <div class="flex h-18 w-full items-center justify-between pl-4 pr-1 ">
                <div class="flex items-center">
                    <div class="avatar mr-3 hidden h-9 w-9 lg:flex">
                        <div
                            class="is-initial rounded-full bg-primary/10 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-lg font-medium tracking-wider text-slate-800 line-clamp-1 dark:text-navy-100">
                        Campos
                    </p>
                </div>
                <button type="button"
                    class="btn h-7 w-7 rounded-full p-0 text-primary hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-accent-light/80 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
            </div>
            <div class="flex h-[calc(100%-4.5rem)] grow flex-col">
                <div>
                    <x-m-fields-create />

                </div>
                <div class="mt-4 flex px-1">
                    <label for="field-search" class="relative mr-1.5 flex">
                        <input type="text" name="fiel-search" id="field-search" placeholder="Buscar..."
                            class="form-input peer h-8 w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 text-xs+ ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900">
                        <span
                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-colors duration-200"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M3.316 13.781l.73-.171-.73.171zm0-5.457l.73.171-.73-.171zm15.473 0l.73-.171-.73.171zm0 5.457l.73.171-.73-.171zm-5.008 5.008l-.171-.73.171.73zm-5.457 0l-.171.73.171-.73zm0-15.473l-.171-.73.171.73zm5.457 0l.171-.73-.171.73zM20.47 21.53a.75.75 0 101.06-1.06l-1.06 1.06zM4.046 13.61a11.198 11.198 0 010-5.115l-1.46-.342a12.698 12.698 0 000 5.8l1.46-.343zm14.013-5.115a11.196 11.196 0 010 5.115l1.46.342a12.698 12.698 0 000-5.8l-1.46.343zm-4.45 9.564a11.196 11.196 0 01-5.114 0l-.342 1.46c1.907.448 3.892.448 5.8 0l-.343-1.46zM8.496 4.046a11.198 11.198 0 015.115 0l.342-1.46a12.698 12.698 0 00-5.8 0l.343 1.46zm0 14.013a5.97 5.97 0 01-4.45-4.45l-1.46.343a7.47 7.47 0 005.568 5.568l.342-1.46zm5.457 1.46a7.47 7.47 0 005.568-5.567l-1.46-.342a5.97 5.97 0 01-4.45 4.45l.342 1.46zM13.61 4.046a5.97 5.97 0 014.45 4.45l1.46-.343a7.47 7.47 0 00-5.568-5.567l-.342 1.46zm-5.457-1.46a7.47 7.47 0 00-5.567 5.567l1.46.342a5.97 5.97 0 014.45-4.45l-.343-1.46zm8.652 15.28l3.665 3.664 1.06-1.06-3.665-3.665-1.06 1.06z">
                                </path>
                            </svg>
                        </span>
                    </label>
                </div>
                <div class="is-scrollbar-hidden mt-3 flex grow flex-col overflow-y-auto">
                    <draggable class="dragArea list-group w-full" :list="fields.origin"
                        :group="{ name: 'people', pull: 'clone', put: false }" :sort="false" :move="checkMove"
                        @change="log">
                        <template v-for="({ icon, name }, index) in fields.origin" :key="index">
                            <x-m-type :icon="icon" :label="name" />
                        </template>
                    </draggable>
                </div>
            </div>
        </div>
        <div class="col-span-4 md:col-span-3">
            <div class="grid grid-cols-12 w-full h-full">
                <div class="col-span-12 md:col-span-3">
                    <draggable class="dragArea list-group w-full border h-full p-2 grid grid-cols-12 content-start gap-2"
                        :list="fields.left" group="people" @change="log" :move="checkMove">
                        <template v-for="(element, index) in fields.left" :key="index.toString().concat('-left')">
                            <x-m-fields-element :element="getNewItem(element, index)"
                                @removeItem="$event=> removeItem($event, 'left')" />
                        </template>
                    </draggable>
                </div>
                <div class="col-span-12 md:col-span-6">
                    <draggable class="dragArea list-group w-full border h-full p-2 grid grid-cols-12 content-start gap-2"
                        :list="fields.defaults" group="people" @change="log" :move="checkMove">
                        <template v-for="(element, index) in fields.defaults" :key="index.toString().concat('-defaults')">
                            <x-m-fields-element :element="getNewItem(element, index)"
                                @removeItem="$event=> removeItem($event, 'defaults')" />
                        </template>
                    </draggable>
                </div>
                <div class="col-span-12 md:col-span-3">
                    <draggable class="dragArea list-group w-full border h-full p-2 grid grid-cols-12 content-start gap-2"
                        :list="fields.right" group="people" @change="log" :move="checkMove">
                        <template v-for="(element, index) in fields.right" :key="index.toString().concat('-right')">
                            <x-m-fields-element :element="getNewItem(element, index)"
                                @removeItem="$event=> removeItem($event, 'right')" />
                        </template>
                    </draggable>
                </div>
            </div>

        </div>
    </div>
</template>
<script setup>
import { get, uniqueId } from 'lodash';
import { ref, inject, onMounted, reactive } from 'vue';

const MAKEAPP = inject('MAKE')

const elements = ref([])
const enabled = ref(true)
const dragging = ref(false)

const showDrawer = ref(false)
const fields = reactive({
    origin: [],
    left: [],
    defaults: [],
    right: [],

})

function onEnd(event) {
    dragging.value = false
    console.log('onEnd')
}

function add(added) {

    console.log("add");
    // console.log('add:', event)
}
function replace() {
    console.log('replace')
}
function checkMove(event) {  
    dragging.value = true
    // console.log('Future index: ' + event.draggedContext.futureIndex)
}
function cloneAction(item) {
    // console.log("cloned", item);
    // elements.value.push(Object.assign({}, item, {
    //     id: item.index
    // }))
}
function log(event) {
    const { moved, added, removed } = event
    // console.log("cloned", moved, added, removed);
    if (moved) {

    }
    if (added) {

    }
    if (removed) {

    }
}

function getNewItem(item, index) {
    return Object.assign({}, item, {
        _id_: uniqueId('destination')
    })
}

function removeValue(value, index, arr) {
    if (value === 2) {
        // Removes the value from the original array
        arr.splice(index, 1);
        return true;
    }
    return false;
}

function removeItem(id, board) {
    fields[board] = fields[board].filter(function (item) {
        console.log(item.id, id)
        return item.id !== id
    });
}

onMounted(async () => {
    const perPage = 1000
    const { data } = await MAKEAPP.get('make/fields', { perPage }).then(resp => resp.data)
    fields.origin = data
})

</script>