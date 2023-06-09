<template>
    <div v-draggable="defaultOptions"
        class="kanban-scrollbar grid grid-cols-12 w-full items-start gap-4 overflow-x-auto overflow-y-hidden  transition-all duration-[.25s]">

        <slot />
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { useApi } from "@/api/useAPI";
import { map } from 'lodash';

const props = defineProps({
    options: {
        type: Object,
        default: {}
    }
})

const defaultOptions = ref(Object.assign({},
    {
        endpoint: 'make/boards',
        options: {
            animation: 200,
            easing: 'cubic-bezier(0, 0, 0.2, 1)',
            delay: 150,
            delayOnTouchOnly: true,
            draggable: '.board-draggable',
            handle: '.board-draggable-handler',
            onSort: function (/**Event*/{ to }) {
                // same properties as onEnd
                const boards = Array.from(to.children).map(item => item.getAttribute('board-id'))
                // map(boards, (id, ordering) => {
                const formData = new FormData()
                formData.append('groups', JSON.stringify(boards))
                formData.append('no-validation', true)
                // formData.append('_method', 'PUT')
                useApi().post('make/boards', formData).then((resp) => {
                    console.log(resp)
                })
                // })
            }
        }
    }, props.options))
</script>