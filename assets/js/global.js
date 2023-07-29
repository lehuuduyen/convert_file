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
                                    <select class="selectpicker select-search-box" data-live-search="true" style="display: none;">
                                        ${getListOptionConverter(listConvertByFile, dataType)}
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
                console.log(index)
                var randomString = generateRandomString(32);
                var valueConvertTo = jQuery("select.select-search-box").eq(index).val();
                var urlUpload = "https://anyconv.com/api/action/add/" + randomString + "/";
                console.log(urlUpload);

                formDataPost.append("file", item, item.name);
                formDataPost.append("to", valueConvertTo);
                var settingsUploadConvert = {
                    "url": urlUpload,
                    "method": "POST",
                    "processData": false,
                    "mimeType": "multipart/form-data",
                    "contentType": false,
                    "xhrFields": {
                        withCredentials: true
                      },
                    "data": formDataPost
                };
                jQuery.ajax(settingsUploadConvert).done(function (response, status, xhr) {
                    var responseHeaders = xhr.getAllResponseHeaders();

                    console.log(responseHeaders);
                    console.log(response);
                    var cookiesHeader = xhr.getResponseHeader('Set-Cookie');
                    // 'data' contains the JSON response from the server (if any)
                    if (cookiesHeader) {
                        // You can parse the cookiesHeader string to extract the cookies if needed
                        console.log('Cookies received:', cookiesHeader);
                    } else {
                        console.log('No cookies received in the response.');
                    }
                    // var urlUploadGet = "https://anyconv.com/api/action/download/" + randomString + "/";
                    // var settingsGetFile = {
                    //     "url": urlUploadGet,
                    //     "type": "GET",
                    //     "dataType": "json",
                    //     "crossDomain": true,
                    //     "dataType" : 'jsonp', 
                    //     // "processData": false,
                    //     // "mimeType": "multipart/form-data",
                    //     // "contentType": false,
                    // };
                    // jQuery.ajax(settingsGetFile).done(function (response) {
                    //     console.log(response);
                    // });
                    getFile(randomString)
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