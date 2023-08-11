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

    try {
        // set_error_handler(function ($severity, $message, $file, $line) {
        //     throw new \ErrorException($message, 0, $severity, $file, $line);
        // });
        $file = $_FILES["file"];
        $tempFilePath = $file['tmp_name'];
        $to = $_POST['to'];
        $targetDirectory = './file/';
        if (is_dir($targetDirectory)) {
            rrmdir($targetDirectory);
        }
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 077, true);
        }
        if ($file['type'] == "image/jpeg" || $file['type'] == "image/jpg") {
            if (mime_content_type($tempFilePath) != "image/jpeg") {
                echo json_encode(array("error" => "Failed to load the JPEG/JPG image."));
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

                    $tempPngFilePath =  './file/' . $output;
                    imagepng($pngImage, $tempPngFilePath);

                    // Clean up memory
                    imagedestroy($jpegImage);
                    imagedestroy($pngImage);
                    echo json_encode(array("success" => true, "message" => $tempPngFilePath));
                    // echo $tempPngFilePath;
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
                    $gifFilePath =  './file/' . $outputGif;
                    imagegif($gifImage, $gifFilePath);
                    imagedestroy($jpegImage);
                    imagedestroy($gifImage);
                    echo json_encode(array("success" => true, "message" => $gifFilePath));
                    // echo $gifFilePath;
                    break;
                case 'pdf':
                    require('fpdf/fpdf.php');

                    $jpegFilePath = $tempFilePath;
                    $pdfFilePath = './file/' . str_replace([".jpg", ".jpeg"], "", $file['name']) . ".pdf";

                    $pdf = new FPDF();
                    $pdf->AddPage();

                    $pdf->SetAutoPageBreak(true, 10);
                    $pdf->Image($jpegFilePath, 10, 10, 190, 0, 'JPEG');

                    $pdf->Output($pdfFilePath, 'F');
                    echo json_encode(array("success" => true, "message" => $pdfFilePath));
                    // echo $pdfFilePath;
                    break;
                case 'jpg':
                    $outputJpg = './file/' . str_replace(".jpeg", "", $file['name']) . ".jpg";
                    rename($tempFilePath, $outputJpg);
                    echo json_encode(array("success" => true, "message" => $outputJpg));
                    // echo $outputJpg;
                    break;
                case 'jpeg':
                    $outputJpeg = './file/' . str_replace(".jpg", "", $file['name']) . ".jpeg";
                    rename($tempFilePath, $outputJpeg);
                    echo json_encode(array("success" => true, "message" => $outputJpeg));
                    // echo $outputJpeg;
                    break;
                default:
                    echo json_encode(array("error" => "Failed to load file."));
            }
        } else if ($file['type'] == "image/png") {
            if (mime_content_type($tempFilePath) != "image/png") {
                echo json_encode(array("error" => "Failed to load the PNG image."));
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

                    $tempJpegFilePath =  './file/' . $output;
                    imagejpeg($jpegImage, $tempJpegFilePath, 90);

                    imagedestroy($pngImage);
                    imagedestroy($jpegImage);
                    echo json_encode(array("success" => true, "message" => $tempJpegFilePath));
                    // echo $tempPngFilePath;
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

                    $tempJpgFilePath =  './file/' . $output;
                    imagejpeg($jpegImage, $tempJpgFilePath, 90);

                    imagedestroy($pngImage);
                    imagedestroy($jpegImage);
                    echo json_encode(array("success" => true, "message" => $tempJpgFilePath));
                    // echo $tempJpgFilePath;
                    break;
                case 'pdf':
                    require('fpdf/fpdf.php');

                    $pngFilePath = $tempFilePath;
                    $pdfFilePath = './file/' . str_replace(".png", "", $file['name']) . ".pdf";

                    $pdf = new FPDF();
                    $pdf->AddPage();

                    $pdf->SetAutoPageBreak(true, 10);
                    $pdf->Image($pngFilePath, 10, 10, 190, 0, 'PNG');

                    $pdf->Output($pdfFilePath, 'F');
                    echo json_encode(array("success" => true, "message" => $pdfFilePath));
                    // echo $pdfFilePath;
                    break;

                default:
                    echo json_encode(array("error" => "Failed to load file."));
            }
        }
    } catch (Exception $e) {
        echo json_encode(array("error" => "Failed to load convert. Please try again."));
    // } finally {
    //     restore_error_handler();
    }
}
