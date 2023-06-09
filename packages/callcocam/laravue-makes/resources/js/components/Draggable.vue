<template>
    <div v-draggable="defaultOptions"
        class="is-scrollbar-hidden max-h-[26rem] relative space-y-3.5 overflow-y-auto p-0.5 grid grid-cols-12 gap-x-4 gap-y-1">

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
        endpoint: 'make/board/items',
        options: {
            animation: 200,
            group: 'board-cards',
            easing: 'cubic-bezier(0, 0, 0.2, 1)',
            direction: 'vertical',
            delay: 150,
            delayOnTouchOnly: true,
            handle: '.board-cards-handler',
            onSort: function (/**Event*/{ to }) {
                // same properties as onEnd
                const boardId = to.getAttribute('board-id')
                const fields = Array.from(to.children).map(item => item.getAttribute('field-id'))
                console.log(fields, boardId)
                const formData = new FormData()
                formData.append('groupId', boardId)
                formData.append('groupColumn', 'make_board_id')
                formData.append('orderings', JSON.stringify(fields))
                formData.append('no-validation', true)
                // formData.append('_method', 'PUT')
                useApi().post(('make/board/items'), formData).then((resp) => {
                    console.log(resp)
                })
                // useApi().post(endpoint, )

            }
        }
    }, props.options))
</script>