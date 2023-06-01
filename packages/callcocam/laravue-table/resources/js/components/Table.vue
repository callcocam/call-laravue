<template>
    <TFilters :label="label">
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
                                <tr v-if="isFilter"
                                    class="border-2 border-transparent border-b-slate-300 dark:border-b-navy-400 shadow-lg mb-2">
                                    <td></td>
                                    <template v-for="({ props }, index) in  this.filters" :key="index">
                                        <td
                                            class=" px-3 py-1 font-semibold  mx-2 text-slate-800 dark:text-navy-100 lg:px-5">
                                            <template v-if="props.filter">
                                                <t-filter v-bind="props"  />
                                            </template>
                                        </td>
                                    </template>
                                    <td></td>
                                </tr>
                                <template v-if="selected.length">
                                    <tr class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                        <td class="px-4 py-2" colspan="100">
                                            <div class="flex items-center w-full space-x-1">
                                                <span>{{ $t('You have selected') }}</span>
                                                <strong class="text-cyan-600 text-lg">{{ selected.length }}</strong>
                                                <span> {{ $t('transactions, do you want to select all') }}</span>
                                                <strong class="text-cyan-700 text-lg">{{ pagination.total }}</strong>
                                                <x-button variant="filled" @click="clearSelected"
                                                    class="ml-1 text-blue-600">{{ $t('Clear all select') }}</x-button>
                                                <span>{{ $t('registers') }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <tr v-for="(model, index) in items" :key="model.id"
                                    class="border border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class=" px-4 py-1 sm:px-5">
                                        <input :value="model.id" v-model="selected" type="checkbox">
                                    </td>
                                    <template v-for="({ props }, index) in  this.columns" :key="index">
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
                <t-pagination v-if="pagination" v-bind="pagination" @filter="getFilters" />
            </template>
        </div>
    </TFilters>
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
            columns: [],
            filters: [],
            isFilter: false,
            isInputActive: false,
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
        getFilters(queryParams) {


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
            this.columns=[]
            this.filters=[]

            const childrens = schema.map(({ childrens }) => {
                return childrens
            })
            childrens.map(s => {
                s.map(column => {
                    if (!get(column.props, 'hideList')) {
                        columns.push(column)
                        this.filters.push(column)
                        this.columns.push(column)
                        if (!get(column.props, 'filter')) {
                            this.isFilter = true
                        }
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