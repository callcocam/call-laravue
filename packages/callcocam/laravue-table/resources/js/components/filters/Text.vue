<template>
    <input :class="[get(dataClasses, type)]" :type="type" :placeholder="label || ''" v-model="form[name]"
        @change="onChange" />
</template>
<script>
import { _, get } from 'lodash';
import { dataClasses } from '@/components/classes';

export default {
    props: {
        type: {
            type: String,
            default: 'text'
        },
        name: {
            type: [String, Boolean],
            default: false
        },
        label: {
            type: [String, Boolean],
            default: false
        },
        alias: {
            type: [String, Boolean],
            default: false
        },
        model: {
            type: Object
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
            form: {},
            dataClasses
        }
    },
    created() {
        this.form[this.name] = this.getQuery()
    },
    methods: {
        getQuery() {
            const { query } = this.$route
            return get(query, this.name, '')
        },
        get(obj, key, _default = {}) {
            if (['date', 'email'].includes(this.type)) {
                return _.get(obj.text, 'default.small', _default)
            }
            return _.get(obj[key], 'default.small', _default)
        },
        onChange(e) {
            const newValue = this.form
            if (get(newValue, this.name)) {
                const query = { ...this.$route.query, ...newValue };
                delete query?.page
                this.$router.push({ name: this.$route.name, query })
            }
            else {
                const query = { ...this.$route.query };
                delete query[this.name]
                delete query?.page
                this.$router.push({ name: this.$route.name, query })
            }
            e.target.focus()
        }
    },

}
</script>