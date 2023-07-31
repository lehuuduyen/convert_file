<?php
error_reporting(9);

if ($_REQUEST['action'] == 'submit') {
    try {
        $ch = curl_init();
        // $filePath = $_FILES['file_upl']['tmp_name'];
        // $fileName = $_FILES['file_upl']['name'];
        $target_format = 'jpg';
        $total_size = 81295;
        $source_mime = 'image%2Fpng';
        $filename = 'duyen.png';
        $fileInfo = $_FILES['file'];
        $filePath = $fileInfo['tmp_name'];
        $fileName = $fileInfo['name'];
        curl_setopt($ch, CURLOPT_URL, "https://mconverter.eu/cf_nocache/ajax/upload.php?target_format=$target_format&total_size=$total_size&source_mime=$source_mime&filename=$filename&abd=false");
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
        if($info && isset($info->token) && $info->token!=""){
            $redirect_url = "https://mconverter.eu/cf_nocache/ajax/download.php?token=".$info->token;
            header("Location: " . $redirect_url);
        }
        elseif(isset($info->daily_limit_exceeded) && $info->daily_limit_exceeded ==true){
            echo "qua gioi han 1 ngay";
        }else{
        echo "upload co loi vui long thu lai";

        }
    } catch (\Throwable $th) {
        throw $th;
    }
    die;
}



?>

<form name="file_up" action="" method="POST" enctype="multipart/form-data">
    Upload your file here
    <input type="file" name="file" id="file_upl" />
    <input type="submit" name="action" value="submit" />
</form>