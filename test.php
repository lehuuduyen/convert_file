<?php
error_reporting(9);
if ($_REQUEST['action'] == 'submit') {
    $ch = curl_init();
    // $filePath = $_FILES['file_upl']['tmp_name'];
    // $fileName = $_FILES['file_upl']['name'];
    $data = array('file' => "C:\Users\BichNgan\Downloads\80635478_1455674667914298_3853063230515576832_n.jpg", 'to' => '7z');
    echo "<pre>";
    print_r($data);
    $random = generateRandomString(32);
    curl_setopt($ch, CURLOPT_URL, 'https://anyconv.com/api/action/add/' . $random);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_exec($ch);
    curl_close($ch);
}

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