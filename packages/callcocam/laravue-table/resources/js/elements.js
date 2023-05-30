/**
 * library.js
 *
 * Note: We're shipping front end code here, file size is critical. This file is
 * overly terse for that reason alone, we wouldn't necessarily recommend this.
 */
const fi = 'T'
const add = (n, c) => ({
    classification: n,
    component: fi + (c || (n[0].toUpperCase() + n.substr(1)))
})
export default {
    // === SINGLE LINE TEXT STYLE INPUTS
    ...[
        'text',
        'email',
        'number',
        'color', 
        'hidden',
        'month',
        'password',
        'search',
        'tel',
        'time',
        'url',
        'week',
        'datetime-local'
    ].reduce((lib, type) => ({ ...lib, [type]: add('Input') }), {}),

    ...[ 
        'file-manager', 
    ].reduce((lib, type) => ({ ...lib, [type]: add('FileManager') }), {}),
    // === SLIDER INPUTS
    range: add('slider'),

    // === MULTI LINE TEXT INPUTS
    textarea: add('textarea'),

    // === BOX STYLE INPUTS
    checkbox: add('box'),
    radio: add('box'),

    // === BUTTON STYLE INPUTS
    submit: add('button'),
    button: add('button'),

    // === SELECT STYLE INPUTS
    select: add('select'),

    editor: add('editor'),

    // === FILE TYPE
    file: add('file'),
    image: add('file'),
    // 'file-manager': add('file-manager', 'Filemanager'),

    // === GROUP TYPE
    group: add('group'),

    // === DATE TYPE
    date: add('date'),

    // === STATUS TYPE
    status: add('status')
}
