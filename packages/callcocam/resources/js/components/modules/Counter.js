class Counter {
    constructor(quill, options) {
        this.container = quill.addContainer('ql-counter');
        quill.on(Quill.events.TEXT_CHANGE, () => {
            const text = quill.getText(); // Gets the plain text content in the editor
            const char = text.replace(/\s/g, ''); // Use regular expressions to remove white space characters
            this.container.innerHTML = `Current char count: ${char.length}`;
        });
    }
}

export default Counter;