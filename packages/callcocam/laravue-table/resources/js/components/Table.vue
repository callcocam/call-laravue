<template>
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
                                    <button
                                        class="btn h-9 w-9 p-0 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">
                                        <x-icon name="fa-edit" class="h-5 w-5" />
                                    </button>
                                    <button
                                        class="btn h-9 w-9 p-0 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">
                                        <x-icon name="fa-eye" class="h-5 w-5" />
                                    </button>
                                    <button
                                        class="btn h-9 w-9 p-0 font-medium text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                        <x-icon name="fa-regular-trash-alt" class="h-5 w-5" />
                                    </button>
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
        <template v-if="!loading">
            <t-pagination v-if="pagination" v-bind="pagination" @filter="filters" />
        </template>
    </div>
</template>
<script>
import { useRoute } from 'vue-router';
import { has, map } from 'lodash';
import { useManagerSelectedStore } from '../stores/selected';

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
        // selectedAll: {
        //     handler: function (newValue, oldValue) {
        //         if (newValue) {
        //             this.selectAll()
        //         } else {
        //             this.clearSelected()
        //         }
        //     },
        // },
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
                endpoint = name.replace('.list', '')
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
                    if (!has(column.props, 'hideList')) {
                        columns.push(column)
                    }
                })
            })
            return columns

        },
        hasCreate() { return this.$route.name.replace('list', 'create').replace('index', 'create') },
        hasEdit() { return this.$route.name.replace('index', 'edit').replace('list', 'edit') },
        hasApiList() { return this.$route.name.replace('.index', '').replace('.list', '').replace('.', '/') }
    }
}

</script>