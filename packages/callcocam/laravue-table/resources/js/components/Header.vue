<template>
    <div class="flex w-full relative">
        <template v-if="ordering">
            <button type="button" class="flex-1" @click="getLink(name)">
                <div class="flex justify-between items-center w-full">
                    <span>{{ label }}</span>
                    <x-icon :name="isSort(name)" class="h-6 w-6" />
                </div>
            </button>
        </template>
        <template v-else>
            <span>{{ label }}</span>
        </template>
        <template v-if="filter">
            <!-- <TFilters /> -->
        </template>
    </div>
</template>
<script>
import { get, has } from 'lodash';

export default {
    props: {
        type: {
            type: String,
            default: 'text'
        },
        label: {
            type: [String, Boolean],
            default: false
        },
        name: {
            type: [String, Boolean],
            default: false
        },
        model: {
            type: [Object, Boolean, String]
        },
        ordering: {
            type: [String, Boolean],
            default: false
        },
        sortable: {
            type: [String, Boolean],
            default: false
        },
        searchable: {
            type: [String, Boolean],
            default: false
        },
        filter: {
            type: [String, Boolean],
            default: false
        },
        options: {
            type: [Object, Array, Boolean],
            default: false
        },
        optionGroups: {
            type: [Object, Boolean],
            default: false
        },
    },
    data() {
        return {
            isSortabled: [],
            isSortabledNme: [],
            sort: get(this.$route.query, this.name, 'ASC') == 'ASC' ? 'DESC' : 'ASC'
        }
    },
    methods: {
        isSort(name) {
            if (has(this.$route.query, name)) {
                if (get(this.$route.query, name) == 'ASC') {
                    return 'fa-sort-up';
                } else if (get(this.$route.query, name) == 'DESC') {
                    return 'fa-sort-down';
                }
            }
            return 'fa-sort';
        },
        getLink(name) {
            if (get(this.$route.query, name) == 'ASC') {
                this.isSortabled = { ...this.$route.query, [name]: this.sort };
                delete this.isSortabled[name]
            } else {
                this.isSortabled = { ...this.$route.query, [name]: this.sort };
            }
            const query = this.isSortabled;

            this.$router.push({ name: this.$route.name, query })
        },
        get(obj, key, _default = {}) {
            return _.get(obj, key, _default)
        }
    }

}
</script>