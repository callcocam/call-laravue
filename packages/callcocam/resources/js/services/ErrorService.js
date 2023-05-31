import Toastify from "toastify-js";
import Swal from 'sweetalert2'
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

    static displaySuccessAlert(message) {
        Swal.fire({
            title: message.title,
            text: message.content,
            icon: "success",
            timer:3000,
            customClass: {
                popup:'bg-white px-4 py-10 text-center transition-opacity duration-300 dark:bg-navy-700 text-slate-700 dark:text-navy-100',
                confirmButton: 'btn bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90',
                closeButton: 'btn bg-info font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90',
                cancelButton: 'btn bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90'
            }
        })
    }
    static displayErrorAlert(err) {
        const { message, response } = err

        // if (message) {
        //     Toastify({ text: message, variant: 'error' }).showToast()
        // }
        if (response) {
            const { data } = response
            const { error } = data
            if (error) {
                Swal.fire({
                    title: "Error!",
                    text: data.message,
                    icon: "error",
                    timer:3000,
                    customClass: {
                        popup:'bg-white px-4 py-10 text-center transition-opacity duration-300 dark:bg-navy-700 text-slate-700 dark:text-navy-100',
                        // confirmButton: 'btn bg-info font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90',
                        confirmButton: 'btn bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90'
                    }
                })
            } else {
                if (data) {
                    Swal.fire({
                        title: "Error!",
                        text: data.message,
                        icon: "error",
                        timer:3000,
                        customClass: {
                            popup:'bg-white px-4 py-10 text-center transition-opacity duration-300 dark:bg-navy-700 text-slate-700 dark:text-navy-100',
                            // confirmButton: 'btn bg-info font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90',
                            confirmButton: 'btn bg-error font-medium text-white hover:bg-error-focus focus:bg-error-focus active:bg-error-focus/90'
                        }
                    })
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