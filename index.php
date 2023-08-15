<?php
error_reporting(E_ERROR | E_PARSE);

$request = $_SERVER['REQUEST_URI'];
$path = str_replace('/', "", $request);

switch ($path) {
    case '':
    case 'index':
    case 'chuyen-doi-png':
    case 'chuyen-doi-png-sang-tinypng':
    case 'chuyen-doi-png-sang-jpg':
    case 'chuyen-doi-png-sang-jpeg':
    case 'chuyen-doi-png-sang-pdf':
    case 'chuyen-doi-png-sang-ico':
    case 'chuyen-doi-jpg':
    case 'chuyen-doi-jpg-sang-tinypng':
    case 'chuyen-doi-jpg-sang-png':
    case 'chuyen-doi-jpg-sang-pdf':
    case 'chuyen-doi-jpg-sang-ico':
    case 'chuyen-doi-jpeg':
    case 'chuyen-doi-jpeg-sang-ico':
    case 'chuyen-doi-jpeg-sang-ico':
    case 'chuyen-doi-jpeg-sang-ico':
        require('convert_page.php');

        break;

    default:
        require('404.html');
        die;
        break;
}
