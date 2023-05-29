import BlockEmbed  from 'quill/blots/embed';
class FileManagerBlot extends BlockEmbed  {
    static create(value) {
        let node = super.create();
        node.setAttribute('alt', value.alt);
        node.setAttribute('src', value.url);
        return node;
    }

    static value(node) {
        return {
            alt: node.getAttribute('alt'),
            url: node.getAttribute('src')
        };
    }
}
FileManagerBlot.blotName = 'file-manager';
FileManagerBlot.tagName = 'img';

export default FileManagerBlot