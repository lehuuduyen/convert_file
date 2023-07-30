<?php
error_reporting(9);


// if ($_REQUEST['action'] == 'submit') {
    
// }
try {
    $_FILES['to'] = '7z';

    $ch = curl_init();
    // $filePath = $_FILES['file_upl']['tmp_name'];
    // $fileName = $_FILES['file_upl']['name'];
    $data = array('file' => "", 'to' => '7z');
   
    $random = generateRandomString(32);
    curl_setopt($ch, CURLOPT_URL, 'https://anyconv.com/api/action/add/' . $random);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $_FILES);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $info = curl_exec($ch);
    // $info = curl_getinfo($ch);
    echo '<pre>';
    print_r($info);
    echo '</pre>';
} catch (\Throwable $th) {
    throw $th;
}
   
    die;
    
    curl_close($ch);
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<form name="file_up" action="" method="POST" enctype="multipart/form-data">
    Upload your file here
    <input type="file" name="file_upl" id="file_upl" />
    <input type="submit" name="action" value="submit" />
</form>