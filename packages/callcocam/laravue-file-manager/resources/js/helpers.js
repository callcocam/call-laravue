import { has } from "lodash";

const downloadFile = async (url, filename) => {
    const response = await fetch(url);
    const blob = await response.blob();
    const urlObject = URL.createObjectURL(blob);

    const link = document.createElement('a');
    link.href = urlObject;
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(urlObject);
}



const setId = (o, id) => {
    if (!has(o, '__id') || id) {
        return Object.defineProperty(o, '__id', Object.assign(Object.create(null), { value: id || token(9) }))
    }
    return o
}

const token = (length = 13) => {
    return Math.random().toString(36).substring(2, length + 2)
}

export { downloadFile, token, setId }
