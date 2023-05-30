
export function extractAttributes(obj, keys) {
    return Object.keys(obj).reduce((props, key) => {
        const propKey = camelCase(key)
        if (keys.includes(propKey)) {
            props[propKey] = obj[key]
        }
        return props
    }, {})
}