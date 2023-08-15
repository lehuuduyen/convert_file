jQuery(document).ready(function () {
    var listConvertByFile = {};
    (async function () {
        try {
            listConvertByFile = await getListConverterByFile();
        } catch (error) {
            console.error(error);
        }
    })();

    triggerUploadFile();

    function triggerUploadFile() {
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

    }
    function displayFile(files) {
        jQuery('div#uploadFile').remove();
        var listHTML = "<div class='files-list'>";
        jQuery.each(files, function (index, item) {
            var extension = item.name.split('.').pop();
            var dataType = item.type.split("/")[1];
            if (extension.includes("jpeg")) {
                dataType = "jpeg";
            } else if (extension.includes("jpg")) {
                dataType = "jpg";
            }
            var fileSizeInKB = parseFloat(item.size / 1024);
            console.log(dataType)
            listHTML += `<div class="file">
                            <div class="file-icon file-icon-lg" data-type="${dataType}">
                                <div class="file-size">${fileSizeInKB.toFixed(1)} KB</div>
                            </div>
                            <div class="file-name">${item.name}</div>
                            <div id="old_size" style="display: none;color:#7eb631"></div>

                            <div>sang</div>
                            <div class="file-format-to">
                                <div class="form-group search">
                                    <select class=" selectpicker select-search-box" data-live-search="true" style="display: none;">
                                        ${getListOptionConverter(listConvertByFile, dataType)}
                                    </select>
                                </div>
                                
                            </div>
                            <div id="new_size" style="display: none;color:#7eb631"></div>

                            <div id="downloadLinkContainer" style="display: none"></div>
                            <div id="percent" style="display: none;color:#7eb631"></div>

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
        var htmlChonTep = `<div tabindex="0" class="dropzone" id="uploadFile">
                                <input type="file" tabindex="-1" multiple autocomplete="off" style="display: none;">
                                <div class="btn">
                                    <button class="uk-button uk-button-primary choose-button">Chọn tệp</button>
                                </div>
                                <p class="uk-text-center">
                                    Chọn tệp hoặc kéo và thả chúng vào đây.
                                </p>
                            </div>`;

        jQuery(".action-bottom .uk-text-center").append(buttonChuyenDoi);

        jQuery('.search select').selectpicker({
            size: false,
        });

        // Delete File
        jQuery('.file-delete').click(function () {
            indexFile = jQuery(this).parent().index();
            files = jQuery.grep(files, function (value) {
                return value !== files[indexFile];
            });
            jQuery(this).parent().remove();
            if (jQuery(".file").length == 0) {
                jQuery('div.files-list').remove();
                jQuery('button.convert-button').remove();
                jQuery(".upload-container-form").prepend(htmlChonTep);
                triggerUploadFile();
            }
        });

        // Convert button
        jQuery('.convert-button').click(function () {
            jQuery.each(files, function (index, item) {
                var formDataPost = new FormData();
                var valueConvertTo = jQuery("select.select-search-box").eq(index).val();
                var urlPost = location.protocol + "/convert.php";

                formDataPost.append("file", item);
                formDataPost.append("to", valueConvertTo);

                var settingsUploadConvert = {
                    "url": urlPost,
                    "method": "POST",
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "data": formDataPost,
                    beforeSend: function () {
                        jQuery(".file #downloadLinkContainer").eq(index).html(`<img style="height:150px" src="./assets/img/loading.gif">`);
                        jQuery(".file #downloadLinkContainer").eq(index).show();
                    },
                };
                jQuery.ajax(settingsUploadConvert).done(function (response, status, xhr) {
                    var result = jQuery.parseJSON(response)
                    if (result.error) {
                        jQuery(".file #downloadLinkContainer").eq(index).html(`<p class="text-danger" style="margin-top: 20px;">${result.error}</p>`);
                        jQuery(".file #downloadLinkContainer").eq(index).show();
                        // jQuery(".file .file-format-to:not([style*='display: none']").eq(index).hide();
                    } else {
                        jQuery(".file #downloadLinkContainer").eq(index).hide();
                        var filename = result.message.substring(result.message.lastIndexOf("/") + 1);
                        // Append the link and trigger the download
                        jQuery(".file #downloadLinkContainer").eq(index).html(`<a href="${result.message}" download='${filename}''>Download</a>`);
                        jQuery(".file #downloadLinkContainer").eq(index).show();
                        let data = jQuery.parseJSON(result.data)
                        jQuery(".file #old_size").eq(index).html(data.oldSize);
                        jQuery(".file #new_size").eq(index).html(data.newSize);
                        jQuery(".file #old_size").eq(index).show();
                        jQuery(".file #new_size").eq(index).show();
                        if(typeof data.percent != "undefined"){
                            jQuery(".file #percent").eq(index).html(data.percent);
                            jQuery(".file #percent").eq(index).show();
                        }else{
                            jQuery(".file #percent").eq(index).hide();

                        }
                        // jQuery(".file .file-format-to").eq(index).hide();
                    }
                });
            });
        });
    }
});

function getFile(randomString) {
    var domainUrl = location.protocol + "//" + location.host;
    var settingsGetFile = {
        url: domainUrl + "/proxy.php?random=" + randomString,
        "type": "POST",
        "xhrFields": { withCredentials: true },
        "dataType": "text",
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "headers": {
            // ''
        }, // Set custom headers here

    };
    jQuery.ajax(settingsGetFile).done(function (response) {
        console.log(response);
    });
}

function getListConverterByFile() {
    return new Promise(function (resolve, reject) {
        jQuery.ajax({
            url: '/assets/lc.txt',
            success: function (data) {
                resolve(JSON.parse(data));
            },
            error: function () {
                console.error("Error reading converter by file.");
                reject("Error reading converter by file.");
            }
        });
    });
}

function getListOptionConverter(list, dataType) {
    var option = "";
    jQuery.each(list[dataType], function (index, item) {
        option += `<option value="${item}">${item.toUpperCase()}</option>`;
    });
    return option;
}

function generateRandomString(length) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        result += characters.charAt(randomIndex);
    }
    return result;
}