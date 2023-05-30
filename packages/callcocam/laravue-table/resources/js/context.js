import { extractAttributes } from "./helpers"

export default {
    context() {
        return {
            http: this.http,
            type: this.type,
            name: this.name,
            model: this.model,
            localAttributes: this.localAttributes,
            slotProps: this.slotProps,
        }
    },
    slotProps,

    
    typeProps
}


function typeProps() {
    return extractAttributes(this.localAttributes, this.$table.typeProps(this.type))
}

function slotProps() {
    const fn = this.$table.slotProps.bind(this.$table)
    return {
        label: fn(this.type, 'label', this.typeProps),
        help: fn(this.type, 'help', this.typeProps),
        errors: fn(this.type, 'errors', this.typeProps),
        repeatable: fn(this.type, 'repeatable', this.typeProps),
        addMore: fn(this.type, 'addMore', this.typeProps),
        remove: fn(this.type, 'remove', this.typeProps),
        component: fn(this.type, 'component', this.typeProps)
    }
}