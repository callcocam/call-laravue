import helper from "./helper.js";


// 表单属性【右面板】
const formConf = {
    tag: "el-form",
    props: {}, childrens: [],
    __rules: {},
    attrs: {
        __formRef: helper.input_text("Nome do formulario", 'refForm'),
        __formModel: helper.input_text("Modelo de formulário", 'formData'),
        size: helper.input_radio("Tamanho do formulário", [
            {
                key: "medium",
                value: "medium"
            }, {
                key: "small",
                value: "small"
            },
            {
                key: "mini",
                value: "mini"
            }
        ], "medium"),
        labelPosition: helper.input_radio("label alignment", [{
            key: "right",
            value: "align-right"
        }, {
            key: "left",
            value: "align-left"
        }, {
            key: "top",
            value: "align-top"
        }], "right"),
        labelWidth: helper.input_number("label width", 100),
        disabled: helper.input_boolean("disabled", false),
        inline: helper.input_boolean("inline mode", false),
        hideRequiredAsterisk: helper.input_boolean("required star", false),
        __formBtns: helper.input_boolean("Whether to display the button", true),
    },
}


const elements = {
    base: { eles: [], title: "basic components" },
    form: { eles: [], title: "form component" },
};

let files =
    import.meta.globEager('./element/form/*.js');

console.log(files, 'AQ')

for (const key in files) {
    elements.form.eles.push(files[key].default)
}
files = import.meta.globEager('./element/base/*.js');


for (const key in files) {
    elements.base.eles.push(files[key].default)
}


export {
    elements,
    formConf
};