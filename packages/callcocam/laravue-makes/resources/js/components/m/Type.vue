<template>
    <div class="flex cursor-move items-center space-x-2.5 px-4 py-1 font-inter hover:bg-slate-150 dark:hover:bg-navy-600">
        <div class="avatar h-10 w-10 items-center">
            <x-icon :name="icon" class="w-7 h-7" />
        </div>
        <div class="flex flex-1 flex-col">
            <div class="flex items-baseline justify-between space-x-1.5">
                <p class="text-xs+ font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                    {{ label }}
                </p>
            </div>
        </div>
    </div>
</template>
<script setup>

const props = defineProps({
    label: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        required: true
    }
})
</script>