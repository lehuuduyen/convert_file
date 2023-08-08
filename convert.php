<?php
if (isset($_POST)) {
    header('Content-Type: application/json; charset=utf-8');
    $file = $_FILES["file"];
    $tempFilePath = $file['tmp_name'];
    $to = $_POST['to'];
    $protocol = strpos($_SERVER['SERVER_SIGNATURE'], '443') !== false ? 'https://' : 'http://';

    if ($file['type'] == "image/jpeg") {
        switch ($to) {
            case "png":
                $output = str_replace(".jpg", "", $file['name']) . ".png";
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
                $outputGif = str_replace(".jpg", "", $file['name']) . ".gif";
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
                $pdfFilePath = './file/' . str_replace(".jpg", "", $file['name']) . ".pdf";

                // Create new PDF instance
                $pdf = new FPDF();
                $pdf->AddPage();

                // Set image scale factor
                $pdf->SetAutoPageBreak(true, 10);
                $pdf->Image($jpegFilePath, 10, 10, 190, 0, 'JPEG');

                // Output the PDF to the browser or save to a file
                $pdf->Output($pdfFilePath, 'F');
                echo $pdfFilePath;
                break;
                //   ...
            default:
        }
        // var_dump($fileResult);
        // exit;
    }
}
