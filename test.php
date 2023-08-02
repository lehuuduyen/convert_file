<?php
error_reporting(9);

try {
    $url = $_POST['url'];
    $ch = curl_init();
    $target_format = 'png';
    $total_size = 21970;
    $source_mime = 'image%2Fjpg';
    $filename = 'duyen.png';
    $fileInfo = $_FILES['file'];
    $filePath = $fileInfo['tmp_name'];
    $fileName = $fileInfo['name'];
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'file' => new CURLFile($filePath, 'application/octet-stream', $fileName)
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $info = curl_exec($ch);
    curl_close($ch);
    $info = json_decode($info);

    // $info = curl_getinfo($ch);
    if ($info && isset($info->token) && $info->token != "") {
        $redirect_url = "https://mconverter.eu/cf_nocache/ajax/download.php?token=" . $info->token;
        header("Location: " . $redirect_url);
        echo 123;die;
    } elseif (isset($info->daily_limit_exceeded) && $info->daily_limit_exceeded == true) {
        echo "qua gioi han 1 ngay";
    } else {
        echo "upload co loi vui long thu lai";
    }
} catch (\Throwable $th) {
    throw $th;
}
die;
?>