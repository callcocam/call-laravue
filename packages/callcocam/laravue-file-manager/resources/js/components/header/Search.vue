<template>
    <div class="flex flex-col relative" @click.self="setIsShowPopper(false)">
        <div class="relative mr-4 flex h-8" v-popper="{ placement: 'bottom', offset: 12, isShowPopper }">
            <input v-model="form.search" ref="popperRef" type="text" name="searchFileManager" id="search-file-manager"
                placeholder="Buscar..." :class="isShowPopper ? 'w-80' : 'w-60'" @focus="setIsShowPopper(true)"
                class="form-input peer h-full w-80 rounded-full bg-slate-150 px-4 pl-9 text-xs+ text-slate-800 ring-primary/50 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:text-navy-100 dark:placeholder-navy-300 dark:ring-accent/50 dark:hover:bg-navy-900 dark:focus:bg-navy-900">
            <div
                class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                <f-icons-icon name="fa-search" class="h-4.5 w-4.5 transition-colors duration-200" />
            </div>

            <div class="popper-root" ref="popperRoot" v-on-click-outside="onClickOutsideHandler">
                <div
                    class="popper-box flex max-h-[calc(100vh-6rem)] flex-col rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-800 dark:bg-navy-700 dark:shadow-soft-dark">
                    <div
                        class="is-scrollbar-hidden flex shrink-0  w-80 overflow-x-auto rounded-t-lg bg-slate-100 px-2 text-slate-600 dark:bg-navy-800 dark:text-navy-200">
                        <button @click="clearParams" type="button" :class="{ ' border-b-2': tabActive == '' }"
                            class="btn shrink-0 rounded-none px-3.5 py-2.5">
                            All
                        </button>
                        <template v-if="filters" v-for="(filter, index) in filters" :key="index">
                            <button :class="{ ' border-b-2': tabActive === path }"
                                v-for="({ label, val, color, icon }, path) in filter" :key="path" type="button"
                                @click="loadFilter(path, val)" class="btn shrink-0 rounded-none px-3.5 py-2.5">
                                {{ label }}
                            </button>
                        </template>
                    </div>
                    <div class="is-scrollbar-hidden overflow-y-auto overscroll-contain pb-2">
                        <div class="mt-3 flex items-center justify-between bg-slate-100 py-1.5 px-3 dark:bg-navy-800">
                            <p class="text-xs uppercase text-slate-400 dark:text-navy-300">
                                Recent
                            </p>
                            <a href="#"
                                class="text-tiny+ font-medium uppercase text-primary outline-none transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70">
                                View All
                            </a>
                        </div>
                        <div class="mt-1 font-inter font-medium">
                            <template v-if="resents">
                                <div v-for="(resent, index) in resents" :key="index"
                                    class="group flex items-center space-x-2 px-2.5 py-2 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                    <template v-if="['png', 'jpg', 'gif'].includes(resent.extension)">
                                        <a target="_blank" :href="resent.link_url" :title="resent.link_url">
                                            <img class="mask is-squircle h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                                                :src="resent.link_url" :alt="resent.name" />
                                        </a>
                                    </template>
                                    <template v-if="['pdf'].includes(resent.extension)" :title="resent.link_url">
                                        <a target="_blank" :href="resent.link_url">
                                            <v-icon name="fa-file-pdf"
                                                class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200" />
                                        </a>
                                    </template>
                                    <template v-if="['mp4'].includes(resent.extension)" :title="resent.link_url">
                                        <a target="_blank" :href="resent.link_url">
                                            <v-icon name="fa-play-circle"
                                                class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200" /></a>
                                    </template>
                                    <template v-if="['mp3'].includes(resent.extension)" :title="resent.link_url">
                                        <a target="_blank" :href="resent.link_url">
                                            <v-icon name="fa-itunes-note"
                                                class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200" /></a>

                                    </template>

                                    <button @click="selectFile(resent)" type="button" class="truncate w-56"
                                        :title="resent.name">{{ resent.name }}</button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script setup>
import { computed, ref, onMounted, watch, reactive } from 'vue'
import { vOnClickOutside } from '@vueuse/components'
import { debounce } from 'lodash'
import { useManagerGlogalStore } from "@file-manager/stores/global"
import { useManagerFiltersStore } from '@file-manager/stores/filters'
import { useManagerFilesStore } from '@file-manager/stores/files'
import { useManagerParamsStore } from '@file-manager/stores/params'

const props = defineProps({
    context: {
        type: Object,
        default: {}
    }
})
const { context } = props

const tabActive = ref('')

const global = useManagerGlogalStore()

const isShowPopper = computed(() => global.isShowPopper)

const popperRoot = ref()

const popperRef = ref()

const resents = ref([])

const setIsShowPopper = (isShowPopper) => {

    global.setIsShowPopper(isShowPopper)

}

const { setParams, hasParam, resetParam, resetParams } = useManagerParamsStore()

const params = computed(() => useManagerParamsStore().params)

const filters = computed(() => useManagerFiltersStore().filters)

const { setFile, loadStoreFiles } = useManagerFilesStore()

const onClickOutsideHandler = [
    (ev) => {
        if (global.isShowPopper) global.setIsShowPopper(false)
    },
    { ignore: [popperRef] }
]
const form = reactive({
    search: ''
})

watch(form, debounce(async ({ search }) => {

    let type = 'file'

    let otherParams = params.value

    if (otherParams.hasOwnProperty('type')) {

        type = otherParams.type

    }

    const obj = { search, type };

    await loadStoreFiles(context.services, { ...otherParams, ...obj })

    await loadRecents({ ...otherParams, ...obj, ...{ recent: '1' } })

}, 500))

const selectFile = (file) => {
    setFile(file)
    global.setIsShowPopper(false)
}

const clearParams = async () => {
    tabActive.value = ''
    resetParams({ type: 'file' })
}

const loadFilter = async (path, val) => {
    tabActive.value = path
    if (hasParam(path)) {
        resetParam(path)
    } else {
        setParams({ [path]: val })
    }
}
const loadRecents = async (params) => {
    const { data } = await context.services.listServiceFiles(params)
    resents.value = data.data
}
onMounted(async () => {
    await loadRecents({ recent: '1' })
})
</script>