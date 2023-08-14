<?php

if (isset($_POST)) {
    function rrmdir($src)
    {
        $dir = opendir($src);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                $full = $src . '/' . $file;
                if (is_dir($full)) {
                    rrmdir($full);
                } else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($src);
    }
    function compress($source, $destination, $quality)
    {

        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);

        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source);

        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source);

        imagejpeg($image, $destination, $quality);

        return $destination;
    }
    function urlPathFile()
    {
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        } else {
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'] . "/" . "file/";
    }

    try {
        set_error_handler(function ($severity, $message, $file, $line) {
            throw new \ErrorException($message, 0, $severity, $file, $line);
        });
        $file = $_FILES["file"];
        $tempFilePath = $file['tmp_name'];
        $to = $_POST['to'];
        $targetDirectory = './file/';
        $currentFloderDomain = './file/';
        if (is_dir($targetDirectory)) {
            chmod($targetDirectory, 0777);
            rrmdir($targetDirectory);
        }
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
        if ($file['type'] == "image/jpeg" || $file['type'] == "image/jpg") {
            if (mime_content_type($tempFilePath) != "image/jpeg") {
                echo json_encode(array("error" => "Failed to load the JPEG/JPG image."));
                exit;
            }
            switch ($to) {
                case "png":
                    $output = str_replace([".jpg", ".jpeg"], "", $file['name']) . ".png";
                    $jpegImage = imagecreatefromjpeg($tempFilePath);
                    // Create a new blank PNG image
                    $width = imagesx($jpegImage);
                    $height = imagesy($jpegImage);
                    $pngImage = imagecreatetruecolor($width, $height);
                    $whiteColor = imagecolorallocate($pngImage, 255, 255, 255);
                    imagefill($pngImage, 0, 0, $whiteColor);
                    imagecopy($pngImage, $jpegImage, 0, 0, 0, 0, $width, $height);

                    $tempPngFilePath =  $currentFloderDomain . $output;
                    imagepng($pngImage, $tempPngFilePath);
                    // Clean up memory
                    imagedestroy($jpegImage);
                    imagedestroy($pngImage);

                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output));
                    break;
                case 'gif':
                    $outputGif = str_replace([".jpg", ".jpeg"], "", $file['name']) . ".gif";
                    $jpegImage = imagecreatefromjpeg($tempFilePath);
                    $width = imagesx($jpegImage);
                    $height = imagesy($jpegImage);
                    $gifImage = imagecreatetruecolor($width, $height);
                    $whiteColor = imagecolorallocate($gifImage, 255, 255, 255);
                    imagefill($gifImage, 0, 0, $whiteColor);
                    imagecopy($gifImage, $jpegImage, 0, 0, 0, 0, $width, $height);
                    $gifFilePath =  $currentFloderDomain . $outputGif;
                    imagegif($gifImage, $gifFilePath);
                    imagedestroy($jpegImage);
                    imagedestroy($gifImage);
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output));
                    // echo $gifFilePath;
                    break;
                case 'pdf':
                    require('fpdf/fpdf.php');
                    $output = str_replace([".jpg", ".jpeg"], "", $file['name']) . ".pdf";

                    $jpegFilePath = $tempFilePath;
                    $pdfFilePath = $currentFloderDomain . $output;

                    $pdf = new FPDF();
                    $pdf->AddPage();

                    $pdf->SetAutoPageBreak(true, 10);
                    $pdf->Image($jpegFilePath, 10, 10, 190, 0, 'JPEG');

                    $pdf->Output($pdfFilePath, 'F');
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output));
                    break;
                case 'jpg':
                    $outputJpg = $currentFloderDomain . str_replace(".jpeg", "", $file['name']) . ".jpg";
                    rename($tempFilePath, $outputJpg);
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output));
                    break;
                case 'jpeg':
                    $outputJpeg = $currentFloderDomain . str_replace(".jpg", "", $file['name']) . ".jpeg";
                    rename($tempFilePath, $outputJpeg);
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output));
                    break;
                case "ico":
                    require('php-ico/class-php-ico.php');
                    $output = str_replace([".jpg", ".jpeg"], "", $file['name']) . ".ico";
                    $tempIcoFilePath =  $currentFloderDomain . $output;
                    $ico_lib = new PHP_ICO($tempFilePath);
                    $ico_lib->save_ico($tempIcoFilePath);
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output));
                    break;
                case "tinyPNG":
                    $source_img = $tempFilePath;
                    $destination_img = $source_img;

                    $d = compress($source_img, $destination_img, 50);
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $destination_img));
                    break;
                default:
                    echo json_encode(array("error" => "Failed to load file."));
            }
        } else if ($file['type'] == "image/png") {
            if (mime_content_type($tempFilePath) != "image/png") {
                echo json_encode(array("error" => "Failed to load the PNG image."));
                exit;
            }
            switch ($to) {
                case "jpeg":
                    $output = str_replace(".png", "", $file['name']) . ".jpeg";
                    $pngImage = imagecreatefrompng($tempFilePath);
                    // Create a new blank PNG image
                    $width = imagesx($pngImage);
                    $height = imagesy($pngImage);
                    $jpegImage = imagecreatetruecolor($width, $height);
                    $whiteColor = imagecolorallocate($pngImage, 255, 255, 255);
                    imagefill($jpegImage, 0, 0, $whiteColor);
                    imagecopy($jpegImage, $pngImage, 0, 0, 0, 0, $width, $height);

                    $tempJpegFilePath =  $currentFloderDomain . $output;
                    imagejpeg($jpegImage, $tempJpegFilePath, 90);

                    imagedestroy($pngImage);
                    imagedestroy($jpegImage);
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output));
                    break;
                case "jpg":
                    $output = str_replace(".png", "", $file['name']) . ".jpg";
                    $pngImage = imagecreatefrompng($tempFilePath);
                    // Create a new blank PNG image
                    $width = imagesx($pngImage);
                    $height = imagesy($pngImage);
                    $jpegImage = imagecreatetruecolor($width, $height);
                    $whiteColor = imagecolorallocate($pngImage, 255, 255, 255);
                    imagefill($jpegImage, 0, 0, $whiteColor);
                    imagecopy($jpegImage, $pngImage, 0, 0, 0, 0, $width, $height);

                    $tempJpgFilePath =  $currentFloderDomain . $output;
                    imagejpeg($jpegImage, $tempJpgFilePath, 90);

                    imagedestroy($pngImage);
                    imagedestroy($jpegImage);
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output));
                    break;
                case 'pdf':
                    require('fpdf/fpdf.php');
                    $output = str_replace(".png", "", $file['name']) . ".pdf";
                    $pngFilePath = $tempFilePath;
                    $pdfFilePath = $currentFloderDomain . $output;

                    $pdf = new FPDF();
                    $pdf->AddPage();

                    $pdf->SetAutoPageBreak(true, 10);
                    $pdf->Image($pngFilePath, 10, 10, 190, 0, 'PNG');

                    $pdf->Output($pdfFilePath, 'F');
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output));
                    break;
                case "ico":
                    require('php-ico/class-php-ico.php');
                    $output = str_replace([".png"], "", $file['name']) . ".ico";
                    $tempIcoFilePath =  $currentFloderDomain . $output;
                    $ico_lib = new PHP_ICO($tempFilePath);
                    $ico_lib->save_ico($tempIcoFilePath);
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output));
                    break;
                case "tinyPNG":
                    $source_img = $tempFilePath;
                    $destination_img = $source_img;

                    $d = compress($source_img, $destination_img, 50);
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $destination_img));
                    break;
                default:
                    echo json_encode(array("error" => "Failed to load file."));
            }
        }
    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        die;

        echo json_encode(array("error" => "Failed to load convert. Please try again."));
    } finally {
        restore_error_handler();
    }
}
