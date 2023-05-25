
class Services {

    constructor(http, endpoint = "file-manager/") {
        this.http = http
        this.endpoint = endpoint
    }

    listServiceFilters(formData = {}) {

        return this.http.get(this.endpoint.concat('filters'), { params: formData })
    }

    listServiceFolders(formData = {}) {

        return this.http.get(this.endpoint.concat('dirs'), formData)
    }

    createServiceFolder(formData = {}) {

        return this.http.post(this.endpoint.concat('dirs'), formData)
    }

    deleteServiceFolder(id, formData = {}) {

        return this.http.delete(this.endpoint.concat('dirs/').concat(id), { params: formData })
    }

    getServiceFile(id, formData = {}) {

        return this.http.get(this.endpoint.concat('files/').concat(id), { params: formData })
    }

    removeServiceFile(id, formData = {}) {

        return this.http.delete(this.endpoint.concat('files/').concat(id), { params: formData })
    }

    listServiceFiles(formData = {}) {

        return this.http.get(this.endpoint.concat('files'), { params: formData })
    }

    updatedServiceFile(id, formData) {

        formData.append('_method', 'PUT')

        return this.http.post(this.endpoint.concat('files/').concat(id), formData)

    }

    uploadServiceFile(formData = {}, options = {}) {
        return this.http.post(this.endpoint.concat('files'), formData, options)
    }

    uploadServiceFilter(formData) {

        return this.http.post(this.endpoint.concat('filters'), formData)
    }
}

export default Services
