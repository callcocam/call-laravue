import { camelCase, has } from "lodash"
import Upload from "./upload"

export function createDebouncer() {
    let timeout
    return function debounceFn(fn, args, delay) {
        if (timeout) {
            clearTimeout(timeout)
        }
        timeout = setTimeout(() => fn.call(this, ...args), delay)
    }
}


export function equals(objA, objB, deep = false) {
    if (objA === objB) {
        return true
    }
    if (!objA || !objB) {
        return false
    }
    if (typeof objA !== 'object' && typeof objB !== 'object') {
        // Compare scalar values
        return objA === objB
    }
    const aKeys = Object.keys(objA)
    const bKeys = Object.keys(objB)
    const len = aKeys.length

    if (bKeys.length !== len) {
        return false
    }

    for (let i = 0; i < len; i++) {
        const key = aKeys[i]
        if ((!deep && objA[key] !== objB[key]) || (deep && !equals(objA[key], objB[key], deep))) {
            return false
        }
    }
    return true
}


export function isEmpty(value) {
    if (typeof value === 'number') {
        return false
    }
    return (
        value === undefined ||
        value === '' ||
        value === null ||
        value === false ||
        (
            Array.isArray(value) && !value.some(v => !isEmpty(v))
        ) ||
        (
            (value && !Array.isArray(value) && typeof value === 'object' && isEmpty(Object.values(value)))
        )
    )
}


export function extractAttributes(obj, keys) {
    return Object.keys(obj).reduce((props, key) => {
        const propKey = camelCase(key)
        if (keys.includes(propKey)) {
            props[propKey] = obj[key]
        }
        return props
    }, {})
}


export function arrayify(item) {
    if (!item) {
        return []
    }
    if (typeof item === 'string') {
        return [item]
    }
    if (Array.isArray(item)) {
        return item
    }
    if (typeof item === 'object') {
        return Object.values(item)
    }
    return []
}


export function setId(o, id) {
    if (!has(o, '__id') || id) {
        return Object.defineProperty(o, '__id', Object.assign(Object.create(null), { value: id || token(9) }))
    }
    return o
}

export function token(length = 13) {
    return Math.random().toString(36).substring(2, length + 2)
}

export function isValueType(data) {
    switch (typeof data) {
        case 'symbol':
        case 'number':
        case 'string':
        case 'boolean':
        case 'undefined':
            return true
        default:
            if (data === null) {
                return true
            }
            return false
    }
}

export function cloneDeep(obj) {
    if (typeof obj !== 'object') {
        return obj
    }
    const isArr = Array.isArray(obj)
    const newObj = isArr ? [] : {}
    for (const key in obj) {
        if (obj[key] instanceof Upload || isValueType(obj[key])) {
            newObj[key] = obj[key]
        } else {
            newObj[key] = cloneDeep(obj[key])
        }
    }
    return newObj
}
