jQuery(document).ready(function () {
    var clickedInsideDiv = false;


    jQuery('#uploadFile').click(function () {
        if (!clickedInsideDiv) {
            clickedInsideDiv = true;
            jQuery(this).find('input[type="file"]').click();
        }

    });

    $('#uploadFile input[type="file"]').click(function (event) {
        event.stopPropagation();
        var target = event.target || event.srcElement;
        console.log(target.value.length)

        if (target.value.length == 0) {
            clickedInsideDiv = false;
        } else {
            clickedInsideDiv = false;
            // Handle file selection here if needed
            console.log("Files selected:", this.files);
        }
    });

    $('#uploadFile input[type="file"]').change(function (event) {
        var target = event.target || event.srcElement;
        console.log(target.value.length)

        if (target.value.length == 0) {
            clickedInsideDiv = false;
        } else {
            clickedInsideDiv = false;
            // Handle file selection here if needed
            console.log("Files selected:", this.files);
        }

    });
    $('#uploadFile input[type="file"]').blur(function (event) {
        var target = event.target || event.srcElement;
        console.log(target.value.length)

        if (target.value.length == 0) {
            clickedInsideDiv = false;
        } else {
            clickedInsideDiv = false;
            // Handle file selection here if needed
            console.log("Files selected:", this.files);
        }

    });


})