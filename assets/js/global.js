jQuery(document).ready(function () {
    const listConverter = ['3gp', '7z', 'ai', 'avi', 'bmp', 'cur', 'dds', 'djvu', 'doc', 'docx', 'dot', 'dst', 'dwg', 'dxf', 'emf', 'eps', 'epub', 'exr', 'fig', 'gif', 'h265', 'hdr', 'heic', 'html', 'ico', 'jpe', 'jpeg', 'map', 'mkv', 'mobi', 'mov', 'mp4', 'mpeg', 'mpg', 'obj', 'odt', 'pbm', 'pcx', 'pdf', 'pgm', 'plt', 'png', 'pnm', 'ppm', 'ps', 'psb', 'psd', 'rar', 'rgb', 'rtf', 'sk', 'stl', 'sun', 'svg', 'tga', 'tif', 'tiff', 'webp', 'wmf', 'wmv', 'xmp', 'xps', 'zip'];
    var clickedInsideDiv = false;

    jQuery('#uploadFile').click(function () {
        if (!clickedInsideDiv) {
            clickedInsideDiv = true;
            jQuery(this).find('input[type="file"]').click();
        }

    });

    jQuery('#uploadFile input[type="file"]').click(function (event) {
        event.stopPropagation();
        var target = event.target || event.srcElement;
        if (target.value.length == 0) {
            clickedInsideDiv = false;
        } else {
            clickedInsideDiv = false;
            displayFile(this.files);
        }
    });

    jQuery('#uploadFile input[type="file"]').change(function (event) {
        var target = event.target || event.srcElement;
        if (target.value.length == 0) {
            clickedInsideDiv = false;
        } else {
            clickedInsideDiv = false;
            displayFile(this.files);
        }

    });
    jQuery('#uploadFile input[type="file"]').blur(function (event) {
        var target = event.target || event.srcElement;
        if (target.value.length == 0) {
            clickedInsideDiv = false;
        } else {
            clickedInsideDiv = false;
            displayFile(this.files);
        }
    });

    function displayFile(files) {
        jQuery('div#uploadFile').remove();
        var listHTML = "<div class='files-list'>";
        jQuery.each(files, function (index, item) {
            var dataType = "";
            var fileSizeInKB = "";
            if (item.type.indexOf("image") !== -1) {
                dataType = item.type.split("/")[1];
                var fileSizeInKB = parseFloat(item.size / 1024);
            }
            listHTML += `<div class="file">
                            <div class="file-icon file-icon-lg" data-type="${dataType}">
                                <div class="file-size">${fileSizeInKB.toFixed(1)} KB</div>
                            </div>
                            <div class="file-name">${item.name}</div>
                            <div class="file-format-to">sang</div>
                            <div class="file-format-to">
                                <div class="form-group search">
                                    <select class="selectpicker" data-live-search="true">
                                        ${getListOptionConverter(listConverter)}
                                    </select>
                                </div>
                                
                            </div>
                            <div class="file-delete">
                                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 12 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"></path>
                                </svg>
                            </div>
                        </div>`;
        });
        listHTML += "</div>";

        // Append the HTML content to the file list
        jQuery(".upload-container-form").prepend(listHTML);

        // Append the button Chuyen Doi
        var buttonChuyenDoi = '<button class="convert-button uk-button uk-button-primary">Chuyển đổi</button>';
        jQuery(".action-bottom .uk-text-center").append(buttonChuyenDoi);

        jQuery('.search select').selectpicker({
            size: false,
        });
    }
});
function getListOptionConverter(list) {
    var option = "";
    jQuery.each(list, function (index, item) {
        option += `<option value="${item}">${item.toUpperCase()}</option>`;
    });
    return option;
}