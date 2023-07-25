<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/assets/css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
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