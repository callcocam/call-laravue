import Toastify from "toastify-js";

class ErrorService {
    constructor() {
        // this.initHandler();
    }

    static onError(error) {
        const response = error.response;
        if (response && response.status >= 400 && response.status < 405) {
            // You can handle this differently
            ErrorService.sentryLogEngine(error);
            return false;
        }
        // Send Error to Log Engine e.g LogRocket
        ErrorService.logRocketLogEngine(error);
    }

    static onWarn(error) {
        // Send Error to Log Engine e.g LogRocket
        this.logRocketLogEngine(error);
    }

    static onInfo(error) {
        // You can handle this differently
        this.sentryLogEngine(error);
    }

    static onDebug(error) {
        const response = error.response;
        if (response && response.status >= 400 && response.status < 405) {
            // You can handle this differently
            this.sentryLogEngine(error);
            return false;
        }
        // Send Error to Log Engine e.g LogRocket
        this.logRocketLogEngine(error);
    }

    static initHandler() {
        const scope = this;
        window.onerror = (message, url, lineNo, columnNo, error) => {
            console.log(error, "test");
            if (error) {
                scope.onError(error);
                console.log(message, url, lineNo, columnNo, error);
            }
        };
    }

    static displayErrorAlert(err) {
        const { message, response } = err

        if (message) {
            Toastify({ text: message, variant: 'error' }).showToast()
        }
        if (response) {
            const { data } = response
            const { error } = data
            if (error) {
                Toastify({ text: error.text, variant: error.variant }).showToast()
            } else {
                if (data) {
                    Toastify({ text: data.message, variant: error.variant}).showToast()
                }
            }
        }
    }

    static logRocketLogEngine(error) {
        // Implement LogRocket Engine here
        console.log(error, "LogRocket");
    }

    static sentryLogEngine(err) {
        // Implement Sentry Engine here
        console.log(err, "Sentry");

    }
}
export default ErrorService