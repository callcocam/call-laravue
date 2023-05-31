<template>
    <div>
        <div class="flex items-center justify-between">
            <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                <span v-if="label"> {{ label }}</span>
            </h2>
            <div class="flex items-center">
                <div class="flex items-center">
                    <label class="block">
                        <input :class="{ 'w-32 lg:w-48': isInputActive, 'w-0': !isInputActive }"
                            class="form-input bg-transparent px-1 text-right transition-all duration-100 placeholder:text-slate-500 dark:placeholder:text-navy-200"
                            placeholder="Search here..." type="text" />
                    </label>
                    <button @click="isInputActive = !isInputActive"
                        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <x-icon name="fa-search" class="h-5 w-5" />
                    </button>
                </div>

                <button @click="isFilterExpanded = !isFilterExpanded"
                    class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18 11.5H6M21 4H3m6 15h6" />
                    </svg>
                </button>
            </div>
        </div>
        <div v-expanded="{ expandedItem: isFilterExpanded, isSpand: isFilterExpanded }" ref="expandedID"
            class="transition-all duration-200">
            <TFilters v-if="isFilterExpanded" />
        </div>
        <div class="card mt-3">
            <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                <table class="w-full text-left">
                    <thead v-if="schema">
                        <tr class="border-2 border-transparent border-b-slate-300 dark:border-b-navy-400 shadow-lg mb-2">
                            <th
                                class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                <input v-model="selectedAll" type="checkbox" @change="selectAll">
                            </th>
                            <template v-for="({ props }, index) in  this.getColumns(schema)" :key="index">
                                <th class=" px-3 py-1 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                    <component is='THeader' v-bind="props" />
                                </th>
                            </template>
                            <th
                                class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="!loading">
                            <template v-if="items">
                                <tr v-for="(model, index) in items" :key="model.id"
                                    class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class=" px-4 py-1 sm:px-5">
                                        <input :value="model.id" v-model="selected" type="checkbox">
                                    </td>
                                    <template v-for="({ props }, index) in  this.getColumns(schema)" :key="index">
                                        <td class="  px-4 py-1 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                            <t-cell v-bind="props" :model="model" />
                                        </td>
                                    </template>
                                    <template v-if="model.hasOwnProperty('actions')">
                                        <td class="  px-4 py-1 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                            <template v-for="({ icon, label, route, path, color }, index) in model.actions"
                                                :key="index">
                                                <template v-if="hasRoutes(route.name)">
                                                    <router-link :to="route" :title="label"
                                                        class="btn h-9 w-9 p-0 font-medium " :class="[color]">
                                                        <x-icon :name="icon" class="h-5 w-5" />
                                                    </router-link>
                                                </template>
                                            </template>
                                        </td>
                                    </template>
                                </tr>
                            </template>
                            <template v-else>

                            </template>
                        </template>
                        <template v-else>
                            <tr class="relative dark:border-b-navy-500">
                                <td class="w-full flex items-center justify-center min-h-[80px]" colspan="100">
                                    <div
                                        class="spinner h-16 w-16 animate-spin rounded-full border-4 border-primary border-r-transparent dark:border-accent dark:border-r-transparent">
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <template v-if="!loading">
                <t-pagination v-if="pagination" v-bind="pagination" @filter="filters" />
            </template>
        </div>
    </div>
</template>
<script>

import { map, get } from 'lodash';

export default {
    props: {
        endpoint: {
            type: [String, Boolean],
            default: false
        }
    },
    data() {
        return {
            selected: [],
            isInputActive: false,
            isFilterExpanded: false,
            selectedAll: false,
            items: false,
            pagination: {},
            schema: false,
            loading: false,
            icon: false,
            label: false,
            http: null
        }
    },
    created() {
        this.get()
    },
    watch: {
        selected: {
            handler: function (newValue, oldValue) {
                this.selectedAll = this.selected.length == this.items.length
            },
        },
    },
    methods: {
        selectAll() {
            if (this.selectedAll) {
                this.items.map(({ id }) => this.selected.push(id))
            } else {
                this.clearSelected()
            }
        },
        clearSelected() {
            this.selected = []
        },
        filters(queryParams) {


            const query = { ...this.$route.query, ...queryParams }
            if (query.hasOwnProperty('page')) {
                delete query.page
            }
            map(query, (item, key) => {
                if (item == '') delete query[key]
            })
            this.$router.push({ name: this.$route.name, query })

        },
        async get() {

            this.loading = true

            const { name, query } = this.$route

            let endpoint = ''
            if (this.endpoint) {
                endpoint = this.endpoint
            } else {
                endpoint = name.replace('.list', '').replace('.destroy', '')
            }

            const params = query

            const { data,
                schema,
                links,
                first_page_url,
                from,
                icon,
                label,
                last_page,
                last_page_url,
                path,
                per_page,
                current_page,
                to,
                total,
                prev_page_url } = await this.$table.get(endpoint, { params }).then(resp => resp.data)

            this.label = label
            this.items = data

            this.schema = schema

            this.pagination = {
                links,
                current_page,
                from,
                last_page,
                first_page_url,
                last_page,
                last_page_url,
                path,
                per_page,
                to,
                total,
                prev_page_url
            }

            this.icon = icon

            this.label = label

            this.loading = false


        },
        getColumns(schema) {

            const columns = []

            const childrens = schema.map(({ childrens }) => {
                return childrens
            })
            childrens.map(s => {
                s.map(column => {
                    if (!get(column.props, 'hideList')) {
                        columns.push(column)
                    }
                })
            })
            return columns

        },
        hasRoutes(route) { return this.$router.hasRoute(route) },
        hasCreate() { return this.$route.name.replace('list', 'create').replace('index', 'create') },
        hasEdit() { return this.$route.name.replace('index', 'edit').replace('list', 'edit') },
        hasApiList() { return this.$route.name.replace('.index', '').replace('.list', '').replace('.', '/') }
    }
}

</script>