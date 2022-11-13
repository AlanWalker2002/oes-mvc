/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    config.filebrowserBrowseUrl = './vendors/ckeditor/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl =
        './vendors/ckeditor/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl =
        './vendors/ckeditor/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl =
        './vendors/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl =
        './vendors/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl =
        './vendors/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
    config.extraPlugins +=
        (config.extraPlugins.length == 0 ? '' : ',') + 'ckeditor_wiris';
};

CKEDITOR.config.allowedContent = true;
