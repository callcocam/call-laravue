<template>
    <div class="relative col-span-12 border hover:border-dashed cursor-pointer p-1 rounded-md group/item"
        :class="[('md:col-span-').concat(element.span)]">
        <div class="absolute z-50  right-1 top-0 group/edit invisible group-hover/item:visible">
            <div class="flex space-x-2">
                <button @click="openDrawer" type="button" class="hover:text-green-200">
                    <x-icon name="fa-edit" class="w-5 h-5" />
                </button>
                <button type="button" class="  hover:text-red-200">
                    <x-icon name="fa-regular-trash-alt" class="w-5 h-5" />
                </button>
            </div>
        </div>
        <CFormInput :type="element.type" :label="element.name" :options="element.options" />
    </div>
    <TransitionRoot :show="showDrawer">
        <TransitionChild class="fixed inset-0 z-[100] bg-slate-900/60 transition-opacity duration-200" @click="closeDrawer"
            enter="ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in" leave-from="opacity-100"
            leave-to="opacity-0">
        </TransitionChild>
        <x-m-sidebar-settings :element="element" @closeDrawer="$event => showDrawer = $event" />
    </TransitionRoot>
</template>
<script setup>
import { computed, ref } from 'vue';
import { TransitionChild, TransitionRoot } from '@headlessui/vue'


const showDrawer = ref(false)

const props = defineProps({
    element: {
        type: [Boolean, Object],
        default: false
    }
})

const closeDrawer = () => {
    showDrawer.value = false
}

const openDrawer = () => {
    showDrawer.value = true
}
</script>