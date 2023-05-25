import { createPopper } from "@popperjs/core";

export default {
    install(app, options = {}) {

        app.config.globalProperties.usePopper = this

    }
}