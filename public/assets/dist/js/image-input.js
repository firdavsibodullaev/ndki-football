function imagePreview(el) {
    const $this = $(el);
    const baseFile = $this.attr('data-file');
    const previewBlock = $this.next();
    const files = $this.prop('files');
    const file = files[0];
    const anchorTag = previewBlock.find('a[data-fancybox]');
    const imgTag = anchorTag.find('img');

    if (files.length < 1) {
        if (!previewBlock.hasClass('d-none') && !baseFile) {
            previewBlock.addClass('d-none');
        }
        anchorTag.attr('data-src', baseFile);
        imgTag.attr('src', baseFile).attr('alt', '');
        return;
    }

    previewBlock.removeClass('d-none');

    let url = URL.createObjectURL(file);

    anchorTag.attr('data-src', url);
    imgTag.attr('src', url).attr('alt', file.name);
}
