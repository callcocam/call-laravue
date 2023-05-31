
export default (el, binding) => {
    const { value, instance } = binding;
    const expanded = value.isSpand;
    const elem = instance.$refs.expandedID;
    if (expanded) {
        elem.style.setProperty("height", `${elem.scrollHeight}px`);
    } else {
        elem.style.setProperty("height", '0');
    }

};
