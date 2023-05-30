<template>
    <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
        <div class="hidden sm:flex items-center space-x-2 text-xs+">
            <span>Mostrar</span>
            <label class="block">
                <select v-model="perPage"
                    class="form-select rounded-full border border-slate-300 bg-white px-2 py-1 pr-6 w-12 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                    <option value="12">12</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </label>
            <span>resultados</span>
        </div>

        <ol class="pagination space-x-1.5">
            <li v-if="isPreviousPage()">
                <router-link :to="getPreviousLink()"
                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-150 text-slate-500 transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:bg-navy-500 dark:text-navy-200 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewbox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </router-link>
            </li>
            <template v-if="links" v-for="({ url, label, active }, index) in getLinks()" :key="index">
                <li v-if="active">
                    <span
                        class="flex h-8 min-w-[2rem] items-center justify-center rounded-lg bg-primary px-3 leading-tight text-white transition-colors  dark:bg-accent ">{{
                            label }}</span>
                </li>
                <li v-else-if="!parseInt(label)">
                    <span
                        class="flex h-8 min-w-[2rem] items-center justify-center rounded-lg bg-primary px-3 leading-tight text-white transition-colors  dark:bg-slate-500">{{
                            label }}</span>
                </li>
                <li v-else>
                    <router-link :to="getLink(label)"
                        class="flex h-8 min-w-[2rem] items-center justify-center rounded-lg bg-slate-150 px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:bg-navy-500 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">{{
                            label }}</router-link>
                </li>
            </template>

            <li v-if="isNextPage()">
                <router-link :to="getNextLink()"
                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-150 text-slate-500 transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:bg-navy-500 dark:text-navy-200 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewbox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </router-link>
            </li>
        </ol>

        <div class="text-xs+">{{ from }} - {{ to }} de {{ total }} resultados</div>
    </div>
</template>
<script>
import { get, isEqual } from 'lodash'



export default {
    props: {
        links: {
            type: [Array],
            default: []
        },
        from: {
            type: [Number, String],
            default: 0
        },
        last_page: {
            type: [String, Number],
            default: 0
        },
        first_page_url: {
            type: [String],
            default: ''
        },
        last_page_url: {
            type: [String],
            default: ''
        },
        path: {
            type: [String],
            default: ''
        },
        per_page: {
            type: [Number, String],
            default: 12
        },
        current_page: {
            type: [Number, String],
            default: 1
        },
        to: {
            type: [Number, String],
            default: 0
        },
        total: {
            type: [Number, String],
            default: 0
        },
        prev_page_url: {
            type: [String],
            default: ''
        }
    },
    data() {
        return {
            perPage: 12
        }
    },
    created() {
        this.perPage = get(this.$route.query, 'perPage', 12)
    },
    watch: {
        perPage: {
            handler: function (perPage, oldValue) {
                if (isEqual(perPage, oldValue)) return
                this.$emit('filter', { perPage })
            },
            deep: true
        }
    },
    methods: {
        getLinks() {
            return this.links.slice(1, -1)
        },
        getLink(page) {
            const query = { ...this.$route.query, page };
            return { name: this.$route.name, query }
        },
        getFirstLink() {
            return { name: this.$route.name, query: { page: 1 } }
        },
        getPreviousLink() {
            return { name: this.$route.name, query: { page: parseInt(this.current_page) - 1 } }
        },
        getNextLink() {
            return { name: this.$route.name, query: { page: parseInt(this.current_page) + 1 } }
        },
        getLastLink() {
            return { name: this.$route.name, query: { page: this.last_page } }
        },
        isPreviousPage() {
            return parseInt(this.current_page) > 1
        },
        isNextPage() {
            return parseInt(this.current_page) < parseInt(this.last_page)
        }
    }
}
</script>