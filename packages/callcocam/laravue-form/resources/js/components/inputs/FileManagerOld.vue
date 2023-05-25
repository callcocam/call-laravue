<template>
    <div :class="context.classes.element" :data-type="context.type">
        <CLabelslot :context="context">
            
            <div class="relative flex -space-x-px">
                <input v-model="context.model" type="text" v-bind="attributes" @blur="context.blurHandler" />
               <button type="button" class="px-4 flex items-center rounded-r-lg bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                    <v-icon name="fa-upload" scale="2" class="h-5 w-5 transition-colors duration-200" />
                </button>
            </div>
        </CLabelslot>
    </div>
</template>
<script>
import Mixin from './../../mixin'
export default {
    mixins: [
        Mixin
    ]

}
</script>