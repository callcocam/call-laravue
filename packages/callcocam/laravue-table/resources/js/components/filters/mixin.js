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
        }
    },
    watch: {
        form: {
            handler: function (newValue, oldValue) {

                console.log(newValue)
            },
            deep: true
        }
    },
    
    computed: {
        type() {
            return this.type
        },
    }
}
