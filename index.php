<?php
$request = $_SERVER['REQUEST_URI'];
$path = str_replace('/', "", $request);

switch ($path) {
    case '':
        require('convert_page.php');
        break;
    case 'index':
        require('convert_page.php');
        break;
    case "jpg-converter":
        require('convert_page.php');
        break;
    case "jpeg-converter":
        require('convert_page.php');
        break;
    case "png-converter":
        require('convert_page.php');
        break;
    case "gif-converter":
        break;
    case "heic-converter":
        break;
    case "svg-converter":
        break;
    case "pdf-converter":
        break;
    case "doc-converter":
        break;
    case "docx-converter":
        break;
    case "xls-converter":
        break;
    case "csv-converter":
        break;
    case "mp3-converter":
        break;
    case "wav-converter":
        break;
    case "m4a-converter":
        break;
    case "ogg-converter":
        break;
    case "flac-converter":
        break;
    case "mp4-converter":
        break;
    case "mov-converter":
        break;
    case "mkv-converter":
        break;
    case "avi-converter":
        break;
    case "flv-converter":
        break;
    case "epub-converter":
        break;
    case "mobi-converter":
        break;
    case "djvu-converter":
        break;
    case "azw3-converter":
        break;
    case "cbr-converter":
        break;
    case "zip-converter":
        break;
    case "rar-converter":
        break;
    case "7z-converter":
        break;
    case "tar-converter":
        break;
    case "cbz-converter":
        break;
    case "otf-converter":
        break;
    case "ttf-converter":
        break;
    case "woff-converter":
        break;
    case "dfont-converter":
        break;
    case "eot-converter":
        break;
    case "dwg-converter":
        break;
    case "dxf-converter":
        break;
    case "dwf-converter":
        break;
    case "dgn-converter":
        break;
    case "scad-converter":
        break;
    case "obj-converter":
        break;
    case "stl-converter":
        break;
    case "fbx-converter":
        break;
    case "dae-converter":
        break;
    case "3ds-converter":
        break;
    default:
        require('404.html');
        die;
        break;
}
