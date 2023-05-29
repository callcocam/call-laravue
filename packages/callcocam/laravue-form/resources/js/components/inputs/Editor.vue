<template>
    <div :class="context.classes.element" :data-type="context.type">
        <FileManager title="Editor" :isOpen="isOpen" :key="context.id" @selectedFile="selectedFile" @close="closeModal"
            :formValue=false>
            <CLabelslot :context="context">
                <editor api-key="qe6snq4uwbfhat2a9pi2exb9bsp0yfhrz6rtq22vq2ovgrnz" :init="options"
                    v-model="context.model" />
                <slot />
            </CLabelslot>
        </FileManager>
    </div>
</template>
<script>
import Mixin from './../../mixin'
import Editor from './../../editor'
export default {
    mixins: [
        Mixin,
        Editor
    ]

}
</script>