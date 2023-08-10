<?php
if (isset($_POST)) {
    header('Content-Type: application/json; charset=utf-8');
    $file = $_FILES["file"];
    $tempFilePath = $file['tmp_name'];
    $to = $_POST['to'];
    if ($file['type'] == "image/jpeg" || $file['type'] == "image/jpg") {
        if (mime_content_type($tempFilePath) != "image/jpeg") {
            echo "Failed to load the JPEG/JPG image.";
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

                $tempPngFilePath =  './file/' . $output;
                imagepng($pngImage, $tempPngFilePath);

                // Clean up memory
                imagedestroy($jpegImage);
                imagedestroy($pngImage);
                echo $tempPngFilePath;
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
                echo $gifFilePath;
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
                echo $pdfFilePath;
                break;
            case 'jpg':
                $outputJpg = './file/' . str_replace(".jpeg", "", $file['name']) . ".jpg";
                rename($tempFilePath, $outputJpg);
                echo $outputJpg;
                break;
            case 'jpeg':
                $outputJpeg = './file/' . str_replace(".jpg", "", $file['name']) . ".jpeg";
                rename($tempFilePath, $outputJpeg);
                echo $outputJpeg;
                break;
            default:
                echo "Failed to load file.";
        }
    } else if ($file['type'] == "image/png") {
        if (mime_content_type($tempFilePath) != "image/png") {
            echo "Failed to load the PNG image.";
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

                $tempPngFilePath =  './file/' . $output;
                imagejpeg($jpegImage, $tempPngFilePath, 90);

                imagedestroy($pngImage);
                imagedestroy($pngImage);
                echo $tempPngFilePath;
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

                $tempPngFilePath =  './file/' . $output;
                imagejpeg($jpegImage, $tempPngFilePath, 90);

                imagedestroy($pngImage);
                imagedestroy($pngImage);
                echo $tempPngFilePath;
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
                echo $pdfFilePath;
                break;

            default:
                echo "Failed to load file.";
        }
    }
}
