<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/assets/css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> -->
    <script src="/assets/js/global.js"></script>
    <title>Demo PHP MVC</title>
</head>

<body>
    <main style="height: auto !important;">
        <div class="uk-section-xsmall" style="height: auto !important;">
            <div class="uk-container uk-text-center">
                <div class="upload-container">
                    <div class="upload-container-form">
                        <div tabindex="0" class="dropzone" id="uploadFile">
                            <input type="file" tabindex="-1" multiple autocomplete="off" style="display: none;">
                            <div class="btn">
                                <button class="uk-button uk-button-primary choose-button">Chọn tệp</button>
                            </div>
                            <p class="uk-text-center">
                                Chọn tệp hoặc kéo và thả chúng vào đây.
                            </p>
                        </div>
                        <div class="action-bottom">
                            <p class="uk-text-center"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>