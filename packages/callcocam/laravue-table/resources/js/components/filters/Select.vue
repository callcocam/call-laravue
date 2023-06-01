<template>
    <select @change="onChange" :class="[get(dataClasses, type)]" v-model="form[name]">
        <template v-if="options">
            <option value="">{{ $t('--select--') }}</option>
            <template v-for="(option, index) in options" :key="index">
                <template v-if="option.hasOwnProperty('value')">
                    <option :value="option.value">{{ option.label }}</option>
                </template>
                <template v-else>
                    <option :value="index">{{ option }}</option>
                </template>
            </template>
        </template>
    </select>
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
    // watch: {
    //     form: {
    //         handler: function (newValue, oldValue) {

    //             const page = 1;
    //             if (get(newValue, this.name)) {
    //                 const query = { ...this.$route.query, ...newValue, page };
    //                 this.$router.push({ name: this.$route.name, query })
    //             }
    //             else {
    //                 const query = { ...this.$route.query, page };
    //                 delete query[this.name]
    //                 this.$router.push({ name: this.$route.name, query })

    //             }
    //         },
    //         deep: true
    //     }
    // },

}
</script>