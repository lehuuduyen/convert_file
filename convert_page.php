<?php
// require('routes.php')
$fileFrom = "PNG";
$fileTo = "TINYPNG";
$path = str_replace('/',"",$_SERVER['REQUEST_URI']);
if($path !=""){
    $arr = explode('-', $path);
    if (count($arr) > 0) {
        $fileFrom = strtoupper($arr[2]);
        $fileTo = strtoupper($arr[4]);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/css/asset.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="/assets/js/global.js"></script>
    <title>Demo PHP MVC</title>
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="position:absolute; width: 0; height: 0">
        <defs>
            <clipPath id="download-anim-a">
                <circle cx="50" cy="50" r="28"></circle>
            </clipPath>
        </defs>
        <symbol viewBox="0 0 100 100" id="icon-convert-anim"><svg id="convert-anim-Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" style="transform-origin:50px 50px 0">
                <g class="ld ld-cycle" style="transform-origin:50px 50px 0;animation-duration:1s;animation-delay:-1s;animation-direction:normal">
                    <g style="transform-origin:50px 50px 0">
                        <path d="M75.26 56.878l-2.535 6.119a1.963 1.963 0 0 1-2.565 1.063l-2.212-.916a1.94 1.94 0 0 0-2.208.505 20.62 20.62 0 0 1-2.087 2.083 1.942 1.942 0 0 0-.51 2.212l.918 2.216a1.963 1.963 0 0 1-1.063 2.565l-6.119 2.535a1.963 1.963 0 0 1-2.565-1.063l-.918-2.216a1.942 1.942 0 0 0-1.925-1.204c-.976.071-1.961.073-2.949.003a1.94 1.94 0 0 0-1.919 1.204l-.916 2.212a1.963 1.963 0 0 1-2.565 1.063l-6.119-2.535a1.963 1.963 0 0 1-1.063-2.565l.916-2.212a1.94 1.94 0 0 0-.505-2.208 20.62 20.62 0 0 1-2.083-2.087 1.942 1.942 0 0 0-2.212-.51l-2.216.918a1.963 1.963 0 0 1-2.565-1.063l-2.535-6.119a1.963 1.963 0 0 1 1.063-2.565l2.216-.918a1.942 1.942 0 0 0 1.204-1.925 20.584 20.584 0 0 1-.003-2.949 1.94 1.94 0 0 0-1.204-1.919l-2.212-.916a1.963 1.963 0 0 1-1.063-2.565l2.535-6.119a1.963 1.963 0 0 1 2.565-1.063l2.212.916a1.94 1.94 0 0 0 2.208-.505 20.62 20.62 0 0 1 2.087-2.083 1.942 1.942 0 0 0 .51-2.212l-.918-2.215a1.963 1.963 0 0 1 1.063-2.565l6.119-2.535a1.963 1.963 0 0 1 2.565 1.063l.918 2.216a1.942 1.942 0 0 0 1.925 1.204 20.584 20.584 0 0 1 2.949-.003 1.94 1.94 0 0 0 1.919-1.204l.916-2.212a1.963 1.963 0 0 1 2.565-1.063l6.119 2.535a1.963 1.963 0 0 1 1.063 2.565l-.916 2.212a1.94 1.94 0 0 0 .505 2.208 20.62 20.62 0 0 1 2.083 2.087 1.942 1.942 0 0 0 2.212.51l2.216-.918a1.963 1.963 0 0 1 2.565 1.063l2.535 6.119a1.963 1.963 0 0 1-1.063 2.565l-2.216.918a1.942 1.942 0 0 0-1.204 1.925c.071.976.073 1.961.003 2.949a1.94 1.94 0 0 0 1.204 1.919l2.212.916a1.962 1.962 0 0 1 1.063 2.564z" fill="#64533b" style="transform-origin:50px 50px 0;animation-duration:1s;animation-delay:-1s;animation-direction:normal"></path>
                        <circle cx="50" cy="50" r="15.5" fill="#80a352" style="transform-origin:50px 50px 0;animation-duration:1s;animation-delay:-.956522s;animation-direction:normal"></circle>
                        <circle cx="50" cy="50" r="9.621" fill="#cfd7cc" style="transform-origin:50px 50px 0;animation-duration:1s;animation-delay:-.913043s;animation-direction:normal"></circle>
                    </g>
                    <g style="transform-origin:50px 50px 0">
                        <path d="M50 86.334l2.57-.085c.428-.02.86-.013 1.286-.054l1.275-.172c.848-.13 1.71-.193 2.549-.375l2.51-.598c.851-.157 1.639-.521 2.461-.779.812-.287 1.644-.531 2.413-.927l2.355-1.081 2.243-1.302c2.922-1.835 5.704-3.981 7.998-6.603 2.327-2.575 4.388-5.442 5.874-8.609l.591-1.172c.184-.396.322-.812.486-1.218.308-.818.646-1.629.933-2.456.444-1.693 1.013-3.364 1.231-5.112l.222-1.3c.087-.432.145-.868.159-1.308l.18-2.635a34.06 34.06 0 0 0-.18-5.284c-.734-7.032-3.581-13.844-8.035-19.418 4.645 5.413 7.779 12.18 8.779 19.324.262 1.782.39 3.588.373 5.391l-.09 2.709c0 .454-.043.903-.116 1.35l-.181 1.345c-.164 1.81-.685 3.552-1.087 5.323-.266.866-.585 1.717-.876 2.578-.155.427-.285.865-.461 1.283l-.57 1.239c-1.434 3.349-3.475 6.421-5.825 9.211-2.317 2.836-5.163 5.208-8.197 7.262l-2.336 1.465-2.466 1.241c-.808.448-1.683.744-2.541 1.081-.868.307-1.704.72-2.606.925l-2.672.735c-.896.226-1.817.331-2.726.502l-1.369.231c-.458.06-.922.072-1.383.109L50 89.334a1.5 1.5 0 0 1-.2-2.992l.044-.002.156-.006z" fill="#80a352" style="transform-origin:50px 50px 0;animation-duration:1s;animation-delay:-.869565s;animation-direction:normal"></path>
                        <path stroke="#80a352" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M50 87.834l5.832 4.666" style="transform-origin:50px 50px 0;animation-duration:1s;animation-delay:-.826087s;animation-direction:normal"></path>
                        <path stroke="#80a352" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M50 87.834l4.666-5.832" style="transform-origin:50px 50px 0;animation-duration:1s;animation-delay:-.782609s;animation-direction:normal"></path>
                    </g>
                    <g style="transform-origin:50px 50px 0">
                        <path d="M50 13.666l-2.563.197c-.426.038-.854.052-1.277.108l-1.264.213c-.839.157-1.691.247-2.517.455l-2.466.673c-.835.182-1.604.569-2.406.849-.793.308-1.6.58-2.352.982l-2.296 1.11-2.18 1.325c-2.834 1.86-5.517 4.015-7.708 6.622-.282.318-.579.623-.85.95l-.767 1.018c-.497.688-1.068 1.327-1.508 2.055l-1.342 2.17c-.457.719-.771 1.516-1.165 2.269l-.565 1.146c-.176.387-.305.794-.46 1.19-.293.799-.623 1.586-.899 2.392-.424 1.649-.977 3.274-1.181 4.976l-.213 1.264c-.084.42-.139.844-.151 1.273l-.168 2.563a34.128 34.128 0 0 0 .139 5.143c.628 6.863 3.122 13.538 7.037 19.544-5.184-4.981-8.67-11.885-9.776-19.198a36.93 36.93 0 0 1 .002-11.078c.177-1.857.715-3.645 1.137-5.459.276-.888.603-1.762.909-2.642.163-.436.301-.883.487-1.31l.596-1.265c3.063-6.808 8.25-12.621 14.553-16.6 6.28-4.074 13.811-6.03 21.215-5.935a1.498 1.498 0 0 1 .102 2.992l-.103.008z" fill="#80a352" style="transform-origin:50px 50px 0;animation-duration:1s;animation-delay:-.73913s;animation-direction:normal"></path>
                        <path stroke="#80a352" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M50 12.166L44.168 7.5" style="transform-origin:50px 50px 0;animation-duration:1s;animation-delay:-.695652s;animation-direction:normal"></path>
                        <path stroke="#80a352" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M50 12.166l-4.666 5.832" style="transform-origin:50px 50px 0;animation-duration:1s;animation-delay:-.652174s;animation-direction:normal"></path>
                    </g>
                </g>
                <style>
                    circle,
                    ellipse,
                    line,
                    path,
                    polygon,
                    polyline,
                    rect {
                        stroke-width: 0
                    }

                    @keyframes ld-cycle {

                        0%,
                        50%,
                        to {
                            animation-timing-function: cubic-bezier(.5, .5, .5, .5)
                        }

                        0% {
                            -webkit-transform: rotate(0);
                            transform: rotate(0)
                        }

                        50% {
                            -webkit-transform: rotate(180deg);
                            transform: rotate(180deg)
                        }

                        to {
                            -webkit-transform: rotate(360deg);
                            transform: rotate(360deg)
                        }
                    }

                    @-webkit-keyframes ld-cycle {

                        0%,
                        50%,
                        to {
                            animation-timing-function: cubic-bezier(.5, .5, .5, .5)
                        }

                        0% {
                            -webkit-transform: rotate(0);
                            transform: rotate(0)
                        }

                        50% {
                            -webkit-transform: rotate(180deg);
                            transform: rotate(180deg)
                        }

                        to {
                            -webkit-transform: rotate(360deg);
                            transform: rotate(360deg)
                        }
                    }

                    .ld.ld-cycle {
                        -webkit-animation: ld-cycle 1s infinite linear;
                        animation: ld-cycle 1s infinite linear
                    }
                </style>
            </svg></symbol>
        <symbol viewBox="0 0 94.37 88.39" id="icon-convert">
            <path class="fil0" d="M27.11 0h37.7c5.96 0 10.83 4.86 10.83 10.82v22a27.882 27.882 0 0 0-8.52-.31V15.67c0-4.71-3.76-6.42-8.38-6.42H29.52c-2.21 0-4.12.77-5.73 2.32L11.16 23.66c-1.75 1.68-2.65 3.79-2.65 6.24v40.69c0 4.71 1.7 8.56 6.32 8.56h34.28a28.26 28.26 0 0 0 16.4 9.22c-.23.01-.46.02-.7.02H10.82C4.86 88.39 0 83.53 0 77.57V26.11c0-3.1 1.16-5.77 3.42-7.89L19.71 2.93C21.79.97 24.25 0 27.11 0z"></path>
            <path class="fil0" d="M23.31 11.02l-12.62 12.1a8.35 8.35 0 0 0-1.95 2.75 7.11 7.11 0 0 0 5.17 2.22h6.95c3.93 0 7.14-3.21 7.14-7.14V13.3c0-1.59-.52-3.05-1.4-4.24-1.21.36-2.3 1.02-3.29 1.96zM40.24 16.89h14.67c2.09 0 3.8 1.7 3.8 3.79s-1.71 3.79-3.8 3.79H40.24a3.8 3.8 0 0 1-3.79-3.79 3.8 3.8 0 0 1 3.79-3.79zM17.99 34.1h37.88c.93 0 1.79.35 2.45.91-3.42 1.62-6.47 3.9-8.97 6.68H17.99c-2.09 0-3.8-1.7-3.8-3.79s1.71-3.8 3.8-3.8zM17.99 47.7h27.22a27.796 27.796 0 0 0-2.59 7.59H17.99c-2.09 0-3.8-1.7-3.8-3.79s1.71-3.8 3.8-3.8zM17.99 61.48h24.15c.09 2.64.53 5.18 1.29 7.59H17.99c-2.09 0-3.8-1.71-3.8-3.8 0-2.08 1.71-3.79 3.8-3.79z"></path>
            <path class="fil1" d="M70.36 36.54c13.26 0 24.01 10.75 24.01 24.01 0 13.27-10.75 24.02-24.01 24.02-13.27 0-24.02-10.75-24.02-24.02 0-13.26 10.75-24.01 24.02-24.01zM57.77 59.36h.1c1.02 0 1.88-.65 2.17-1.62.42-1.42 1.03-2.55 1.88-3.66 3.04-3.96 8.59-5.54 13.52-3.47.32.14 2.15 1.04 2.38 1.42l-2.15 2.1c-.29.28-2.02 1.89-2.09 2.14.12.07 11.28 1.98 12.1 2.03 0-.48-1.35-8.3-1.5-9.14-.08-.51-.17-1.01-.25-1.51-.07-.36-.17-1.2-.29-1.49-.63.5-1.99 2.16-2.41 2.42-.15-.04-1.38-.92-1.65-1.08-.6-.37-1.17-.68-1.79-.97-4.27-2.02-9.49-1.9-13.56-.01-2.68 1.25-4.58 2.93-6.09 4.9-1.05 1.37-1.96 3.15-2.53 5-.22.71-.1 1.42.34 2.02.44.59 1.08.92 1.82.92zm5.14 10.41c.06-.15 2.82-2.78 3.19-3.16.29-.28.87-.78 1.07-1.08-.12-.06-11.39-2.01-12.14-2.04.09 1.02.78 4.76 1 6.08.18 1.16.82 5.19 1.04 6.05.31-.15 2.05-2.15 2.42-2.42.21.07 1.24.85 1.63 1.08.6.37 1.16.67 1.8.97 5.46 2.63 12.51 1.66 16.96-2.07.51-.44.97-.88 1.42-1.35 1.47-1.53 2.4-2.8 3.29-4.97.14-.35.33-.91.51-1.52.21-.71.09-1.41-.36-2-.44-.59-1.07-.91-1.81-.91h-.07c-1.03 0-1.9.65-2.18 1.64-.09.31-.21.67-.45 1.24-.4.94-.91 1.71-1.4 2.36-.94 1.25-2.47 2.56-4.19 3.34-.79.35-1.85.76-2.79.92-.88.15-2.73.18-3.66.07-1.55-.18-4.16-1.18-5.28-2.23z"></path>
        </symbol>
        <symbol viewBox="0 0 100 100" id="icon-download-anim">
            <circle cx="50" cy="50" r="37" fill="#64533b" stroke="#80a352" stroke-width="6"></circle>
            <g clip-path="url(#download-anim-a)">
                <g transform="translate(50 26.58)">
                    <path d="M10.995-2.653v-17.992a.38.38 0 0 0-.38-.379h-21.23a.38.38 0 0 0-.38.38v17.991h-10.97a.534.534 0 0 0-.404.883L-.404 20.84a.534.534 0 0 0 .807 0L22.368-1.77a.534.534 0 0 0-.403-.883h-10.97z" fill="#cfd7cc"></path>
                    <animateTransform attributeName="transform" type="translate" calcMode="linear" values="50 -20;50 120" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite"></animateTransform>
                </g>
            </g>
        </symbol>
        <symbol viewBox="0 0 129.74 121.52" id="icon-download">
            <path class="fil0" d="M37.28 0h51.83c8.19 0 14.87 6.68 14.87 14.88v30.24a38.52 38.52 0 0 0-7.26-.68c-1.5 0-2.98.08-4.44.25V21.54c0-6.48-5.18-8.83-11.53-8.83H40.59c-3.05 0-5.67 1.06-7.89 3.19L15.34 32.52c-2.4 2.31-3.64 5.21-3.64 8.58v55.94c0 6.48 2.33 11.77 8.68 11.77h47.14c5.72 6.53 13.61 11.13 22.54 12.68-.32.02-.63.03-.95.03H14.88c-8.2 0-14.88-6.68-14.88-14.88V35.9c0-4.26 1.59-7.93 4.7-10.85L27.09 4.03C29.96 1.34 33.34 0 37.28 0z"></path>
            <path class="fil0" d="M32.05 15.16L14.69 31.78a11.755 11.755 0 0 0-2.67 3.78 9.745 9.745 0 0 0 7.1 3.06h9.56c5.4 0 9.82-4.42 9.82-9.82V18.28c0-2.18-.72-4.19-1.93-5.83-1.66.51-3.16 1.41-4.52 2.71zM55.33 23.21h20.16c2.87 0 5.22 2.35 5.22 5.22 0 2.87-2.35 5.22-5.22 5.22H55.33c-2.87 0-5.22-2.35-5.22-5.22 0-2.87 2.35-5.22 5.22-5.22zM24.73 46.89h52.08c1.28 0 2.46.47 3.37 1.24a38.73 38.73 0 0 0-12.33 9.19H24.73c-2.87 0-5.22-2.35-5.22-5.22 0-2.87 2.35-5.21 5.22-5.21zM24.73 65.58h37.43a38.357 38.357 0 0 0-3.57 10.44H24.73c-2.87 0-5.22-2.35-5.22-5.22 0-2.87 2.35-5.22 5.22-5.22zM24.73 84.52h33.2c.12 3.63.73 7.13 1.78 10.44H24.73c-2.87 0-5.22-2.35-5.22-5.22 0-2.87 2.35-5.22 5.22-5.22z"></path>
            <path class="fil1" d="M96.72 50.23c18.24 0 33.02 14.79 33.02 33.02 0 18.23-14.78 33.01-33.02 33.01-18.23 0-33.01-14.78-33.01-33.01 0-18.23 14.78-33.02 33.01-33.02zm4.15 14.85c-.02-3.18-3.41-5.16-6.19-3.61-1.31.75-2.09 2.1-2.1 3.61V82.8H79.54l17.18 26.08 17.19-26.08h-13.04V65.08z"></path>
        </symbol>
        <symbol viewBox="0 0 58 58" id="icon-file">
            <path fill="#efebde" d="M46 14L32 0H1v58h45z"></path>
            <g fill="#d5d0bb">
                <path d="M11 23h25a1 1 0 1 0 0-2H11a1 1 0 1 0 0 2zM11 15h10a1 1 0 1 0 0-2H11a1 1 0 1 0 0 2zM36 29H11a1 1 0 1 0 0 2h25a1 1 0 1 0 0-2zM36 37H11a1 1 0 1 0 0 2h25a1 1 0 1 0 0-2zM36 45H11a1 1 0 1 0 0 2h25a1 1 0 1 0 0-2z"></path>
            </g>
            <path fill="#d5d0bb" d="M32 0v14h14z"></path>
            <path fill="#48a0dc" d="M35 36h22v22H35z"></path>
            <path fill="#fff" d="M45 42h2v16h-2z"></path>
            <path fill="#fff" d="M51.293 48.707L46 43.414l-5.293 5.293-1.414-1.414L46 40.586l6.707 6.707z"></path>
        </symbol>
        <symbol viewBox="0 0 74.31 69.61" id="icon-upload">
            <path class="fil0" d="M21.35 0h29.69c4.69 0 8.52 3.83 8.52 8.52v17.32a22.66 22.66 0 0 0-4.16-.39c-.86 0-1.71.05-2.54.15V12.34c0-3.71-2.97-5.06-6.61-5.06h-23c-1.75 0-3.25.61-4.52 1.83l-9.94 9.52c-1.38 1.32-2.09 2.98-2.09 4.91v32.05c0 3.71 1.34 6.74 4.98 6.74h26.99a22.26 22.26 0 0 0 12.91 7.26c-.18.01-.36.02-.54.02H8.52C3.83 69.61 0 65.78 0 61.08V20.56c0-2.44.91-4.54 2.69-6.21L15.52 2.31C17.16.77 19.1 0 21.35 0z"></path>
            <path class="fil0" d="M18.36 8.68L8.42 18.2c-.68.65-1.19 1.37-1.54 2.17a5.618 5.618 0 0 0 4.07 1.75h5.48c3.09 0 5.62-2.53 5.62-5.62v-6.03c0-1.25-.41-2.4-1.1-3.34-.95.29-1.81.81-2.59 1.55zM31.69 13.3h11.55a2.99 2.99 0 0 1 2.99 2.98v.01a2.99 2.99 0 0 1-2.99 2.98H31.69c-1.64 0-2.99-1.34-2.99-2.98v-.01c0-1.64 1.35-2.98 2.99-2.98zM14.16 26.86H44c.73 0 1.41.27 1.93.71a22.27 22.27 0 0 0-7.07 5.26h-24.7a2.99 2.99 0 0 1-2.98-2.99c0-1.64 1.34-2.98 2.98-2.98zM14.16 37.57H35.6c-.95 1.85-1.64 3.86-2.04 5.97h-19.4a2.99 2.99 0 0 1-2.98-2.99c0-1.64 1.34-2.98 2.98-2.98zM14.16 48.41h19.03c.06 2.08.41 4.09 1.01 5.98H14.16a2.99 2.99 0 0 1-2.98-2.99c0-1.64 1.34-2.99 2.98-2.99z"></path>
            <path class="fil1" d="M55.4 28.77c10.45 0 18.91 8.47 18.91 18.91 0 10.45-8.46 18.92-18.91 18.92-10.44 0-18.91-8.47-18.91-18.92 0-10.44 8.47-18.91 18.91-18.91zm2.38 31.22c-.01 1.82-1.95 2.96-3.54 2.07-.76-.43-1.2-1.2-1.21-2.07V49.84h-7.47L55.4 34.9l9.85 14.94h-7.47v10.15z"></path>
        </symbol>
    </svg>
    <main style="height: auto !important;">
        <br>
        <div style="text-align: center;"><h1  class="text-color">Chuyển <?=$fileFrom?> sang <?=$fileTo?></h1></div>
        <div class="uk-card uk-card-default uk-card-hover uk-card-body form-section" style="height: auto !important;">
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
        <div class="uk-section-xsmall uk-section-muted">
            <div class="uk-container ">
                <div class="uk-card uk-card-default uk-card-hover uk-text-center">
                    <div class="uk-card-header">
                        <h2>Làm cách nào để chuyển đổi <?=$fileFrom?> sang <?=$fileTo?> trực tuyến?</h2>
                        <div>Hướng dẫn từng bước để chuyển đổi <?=$fileFrom?> sang <?=$fileTo?> miễn phí. Nó hoạt động trên PC (Windows, Mac, Linux) và thiết bị di động (iPhone, Android).</div>
                    </div>
                    <div class="uk-card-body uk-padding-small uk-padding-remove-top uk-margin-remove uk-flex uk-child-width-1-3@m content--how-to-convert__steps">
                        <div class="step">
                            <div class="uk-margin-remove-adjacent step--img"> <svg class="uk-width-small">
                                    <use xlink:href="#icon-upload"></use>
                                </svg> </div>
                            <div class="step--title">
                                <h3 id="#step-1">Tải lên tệp <?=$fileFrom?></h3>
                            </div>
                            <div class="step--description">Kéo và thả tệp <?=$fileFrom?> của bạn vào khu vực tải lên. Kích thước tệp tối đa là 100&nbsp;MB.</div>
                        </div>
                        <div class="step" id="step-2">
                            <div class="uk-margin-remove-adjacent step--img"> <svg class="uk-width-small">
                                    <use xlink:href="#icon-convert"></use>
                                </svg> </div>
                            <div class="step--title">
                                <h3>đổi <?=$fileFrom?> sang <?=$fileTo?></h3>
                            </div>
                            <div class="step--description">Nhấp vào "Chuyển đổi" để thay đổi <?=$fileFrom?> thành <?=$fileTo?>. Quá trình chuyển đổi thường mất vài giây.</div>
                        </div>
                        <div class="step">
                            <div class="uk-margin-remove-adjacent step--img"> <svg class="uk-width-small">
                                    <use xlink:href="#icon-download"></use>
                                </svg> </div>
                            <div class="step--title">
                                <h3 id="#step-3">Tải xuống tệp <?=$fileTo?></h3>
                            </div>
                            <div class="step--description">Bây giờ bạn có thể tải xuống tệp <?=$fileTo?>. Liên kết tải xuống chỉ hoạt động trên thiết bị của bạn.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-section-xsmall uk-padding-remove">
            <div class="uk-container">
                <div class="uk-card uk-card-body ">
                    <div class="uk-text-left uk-text-large">
                        <h3 class="text-color"> Chuyển đổi PNG </h3>
                    </div>
                    <div class="uk-container uk-align-center uk-child-width-1-1@s uk-child-width-1-6@l r">
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-png-sang-tinypng/"> PNG sang TINYPNG </a> </div>
                        </div>
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-png-sang-jpg/"> PNG sang JPG </a> </div>
                        </div>
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-png-sang-jpeg/"> PNG sang JPEG </a> </div>
                        </div>
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-png-sang-pdf/"> PNG sang PDF </a> </div>
                        </div>
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-png-sang-ico/"> PNG sang ICO </a> </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-container">
                <div class="uk-card uk-card-body ">
                    <div class="uk-text-left uk-text-large">
                        <h3 class="text-color"> Chuyển đổi JPG </h3>
                    </div>
                    <div class="uk-container uk-align-center uk-child-width-1-1@s uk-child-width-1-6@l r">
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-jpg-sang-tinypng/"> JPG sang TINYPNG </a> </div>
                        </div>
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-jpg-sang-png/"> JPG sang PNG </a> </div>
                        </div>
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-jpg-sang-pdf/"> JPG sang PDF </a> </div>
                        </div>
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-jpg-sang-ico/"> JPG sang ICO </a> </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="uk-container">
                <div class="uk-card uk-card-body ">
                    <div class="uk-text-left uk-text-large">
                        <h3 class="text-color"> Chuyển đổi JPEG </h3>
                    </div>
                    <div class="uk-container uk-align-center uk-child-width-1-1@s uk-child-width-1-6@l r">
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-jpeg-sang-ico/"> JPEG sang PNG </a> </div>
                        </div>
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-jpeg-sang-ico/"> JPEG sang PDF </a> </div>
                        </div>
                        <div class="uk-button">
                            <div class="uk-text-center"> <a href="/chuyen-doi-jpeg-sang-ico/"> JPEG sang ICO </a> </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>