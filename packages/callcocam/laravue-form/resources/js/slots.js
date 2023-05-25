import { has } from 'lodash'
import { h, resolveComponent } from 'vue'

const DynamicHeading = (props, { attrs, slots }) => {
    var { name, forceWrap, context, ...mergeWithContext } = props

    if (has(context.slotComponents, props.name)) {
        return h(resolveComponent(context.slotComponents[name]), attrs, slots)
    }
    return null
}

export default DynamicHeading