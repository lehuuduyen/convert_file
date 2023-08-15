<?php

if (isset($_POST)) {
    function getSize($image)
    {
        return number_format((int)filesize($image) / 1024, 2, '.', '') . 'KB';
    }
    function getObjectSize($image,$imageName){
        $result['oldSize'] = getSize($image);
        // $result['newSize'] = getSize('file/compress_' . $imageName);
        $result['newSize'] = getSize( $imageName);
        return $result;
    }
    function resizeImage($image, $imageName, $outputQuality)
    {
        try {
            //code...
            $result = [];

            $imageInfo = getimagesize($image);


            $result['oldSize'] = getSize($image);
            $result['mime'] = $imageInfo['mime'];


            if ($imageInfo['mime'] == 'image/gif') {

                $imageLayer = imagecreatefromgif($image);
            } elseif ($imageInfo['mime'] == 'image/jpeg') {

                $imageLayer = imagecreatefromjpeg($image);
            } elseif ($imageInfo['mime'] == 'image/png') {

                $imageLayer = imagecreatefrompng($image);
            }

            $compressedImage = imagejpeg($imageLayer, 'file/compress_' . $imageName, $outputQuality);


            if ($compressedImage) {
                $result['newSize'] = getSize('file/compress_' . $imageName);
                $result['percent'] = '-'.number_format(100 - ((int)$result['newSize'] * 100 / (int)$result['oldSize']), 2, '.', '') . "%";
                return $result;
                exit;
            } else {
                return 'An error occured!';
                exit;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
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
        $file['name'] = time()."_".rand(1,9999)."_".$file['name'];
        $tempFilePath = $file['tmp_name'];
        $to = $_POST['to'];
        $targetDirectory = './file/';
        $currentFloderDomain = 'file/';
     
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
        if (mime_content_type($tempFilePath) == "image/jpeg") {
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
                    $result = getObjectSize($tempFilePath,'file/' . $output);
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output, 'data' => json_encode($result)));
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
                    $result = getObjectSize($tempFilePath,'file/' . $outputGif);

                    echo json_encode(array("success" => true, "message" => urlPathFile() . $outputGif, 'data' => json_encode($result)));                    // echo $gifFilePath;
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
                    $result = getObjectSize($tempFilePath,'file/' . $output);

                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output, 'data' => json_encode($result)));
                    break;
                case 'jpg':
                    $outputJpg = $currentFloderDomain . str_replace(".jpeg", "", $file['name']) . ".jpg";
                    rename($tempFilePath, $outputJpg);
                   
                    $result = getObjectSize($tempFilePath, $outputJpg);

                    echo json_encode(array("success" => true, "message" => urlPathFile() . $outputJpg));
                    break;
                case 'jpeg':
                    $outputJpeg = $currentFloderDomain . str_replace(".jpg", "", $file['name']) . ".jpeg";
                    rename($tempFilePath, $outputJpeg);
                 
                    
                    $result = getObjectSize($tempFilePath, $outputJpeg);

                    echo json_encode(array("success" => true, "message" => urlPathFile() . $outputJpeg, 'data' => json_encode($result)));
                    break;
                case "ico":
                    require('php-ico/class-php-ico.php');
                    $output = str_replace([".jpg", ".jpeg"], "", $file['name']) . ".ico";
                    $tempIcoFilePath =  $currentFloderDomain . $output;
                    $ico_lib = new PHP_ICO($tempFilePath);
                    $ico_lib->save_ico($tempIcoFilePath);
                    $result = getObjectSize($tempFilePath, 'file/' .$output);
                    
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output, 'data' => json_encode($result)));
                    break;
                case "tinyPNG":
                    $sourceImg = $tempFilePath;
                    $fileName = $file['name'];

                    $d = resizeImage($sourceImg, $fileName, 50);


                    echo json_encode(array("success" => true, "message" => urlPathFile() . 'compress_' . $fileName, 'data' => json_encode($d)));
                    break;
                default:
                    echo json_encode(array("error" => "Failed to load file."));
            }
        } else if (mime_content_type($tempFilePath) == "image/png") {

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
                    $result = getObjectSize($tempFilePath, 'file/' .$output);

                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output, 'data' => json_encode($result)));
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
                    $result = getObjectSize($tempFilePath, 'file/' .$output);

                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output, 'data' => json_encode($result)));
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
                    $result = getObjectSize($tempFilePath, 'file/' .$output);

                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output, 'data' => json_encode($result)));
                    break;
                case "ico":
                    require('php-ico/class-php-ico.php');
                    $output = str_replace([".png"], "", $file['name']) . ".ico";
                    $tempIcoFilePath =  $currentFloderDomain . $output;
                    $ico_lib = new PHP_ICO($tempFilePath);
                    $ico_lib->save_ico($tempIcoFilePath);
                    $result = getObjectSize($tempFilePath, 'file/' .$output);
                    echo json_encode(array("success" => true, "message" => urlPathFile() . $output, 'data' => json_encode($result)));
                    break;
                case "tinyPNG":
                    $sourceImg = $tempFilePath;
                    $fileName = $file['name'];

                    $d = resizeImage($sourceImg, $fileName, 50);


                    echo json_encode(array("success" => true, "message" => urlPathFile() . 'compress_' . $fileName, 'data' => json_encode($d)));
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
