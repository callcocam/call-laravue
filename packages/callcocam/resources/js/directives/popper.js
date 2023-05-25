import { nextTick, watch } from 'vue'
import { createPopper } from "@popperjs/core";
const buildOptions = (options) => {
    const config = {
        placement: options.placement ?? "auto",
        strategy: options.strategy ?? "fixed",
        onFirstUpdate: options.onFirstUpdate ?? function () { },

        modifiers: [
            {
                name: "offset",
                options: {
                    offset: [0, options.offset ?? 0],
                },
            },
        ],
    };

    if (options.modifiers) config.modifiers.push(...options.modifiers);

    return config;
};


export default (el, binding) => {
    const { value, instance } = binding;
    const { isShowPopper } = value;
    const options = buildOptions(value);
    const popperInstance = createPopper(
        instance.$refs.popperRef,
        instance.$refs.popperRoot,
        options
    );
    if (isShowPopper) {
        instance.$refs.popperRoot.classList.add('show')
    } else {
        instance.$refs.popperRoot.classList.remove('show')
    }

};
