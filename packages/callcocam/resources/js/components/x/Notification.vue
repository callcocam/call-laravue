<template>
    <div>
        <div id="customNotification">
            <div class="flex max-w-xs overflow-hidden rounded-lg bg-navy-600 font-normal">
                <div class="flex items-start p-4">
                    <div class="avatar h-10 w-10" v-if="icon">
                        <x-icon :name="icon" />
                    </div>
                </div>
                <div class="p-2">
                    <div class="flex items-center justify-between space-x-2">
                        <h5 class="font-medium tracking-wide text-navy-100 line-clamp-1 lg:text-base">
                            {{ title }}
                        </h5>
                        <button data-notification-remove
                            class="btn h-7 w-7 rounded-full p-0 text-white hover:bg-white/20 focus:bg-white/20 active:bg-white/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <p class="text-navy-100">{{ text }}</p>
                    <div class="flex justify-end px-3 py-1">
                        <a href="#" class="uppercase text-accent-light hover:underline">show</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Toastify from "toastify-js";
export default {
    props: {
        icon: {
            type: [Boolean, String],
            default: 'fa-regular-grin-squint-tears'
        },
        title: {
            type: [Boolean, String],
            default: 'Atenção'
        },
        text: {
            type: [Boolean, String],
            default: ''
        },
        color: {
            type: [Boolean, String],
            default: ''
        },
        content: {
            type: [Boolean, String],
            default: ''
        },
        item: {
            type: [Boolean, String, Object],
            default: false
        },
        time: {
            type: [Boolean, String],
            default: false
        },
        variant: {
            type: [Boolean, String],
            default: 'success'
        }
    },
    watch: {
        text: {
            handler: function (newValue, oldValue) {
                Toastify({ selector: 'customNotification', duration: 3000 }).showToast()
            }
        }
    }
}
</script>