import tippy, { followCursor, roundArrow } from "tippy.js";

const buildOptionsFromModifiers = (modifiers, value) => {
    const options = {
        plugins: [],
        arrow: roundArrow,
        animation: "shift-away",
        zIndex: 10003,
        content: value,
    };
    if (modifiers.hasOwnProperty("placement")) {
        if (modifiers.hasOwnProperty("right")) {
            options.placement = "right";
        }
    }
    return options;
};

export default (el, binding) => {
    const { modifiers, value } = binding;
    const options = buildOptionsFromModifiers(modifiers, value);
    tippy(el, options);
};
