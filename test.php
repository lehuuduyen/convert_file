<?php
error_reporting(9);

$url = 'https://anyconv.com/api/action/download/4c8963890ce171c985b7ca90b504f7ds/';
$cookieValue = 'eyJpdiI6IitHWFdWSmhWcnE5V04zbmlwcTdZcHc9PSIsInZhbHVlIjoiVTFZVUZ6NE9oV2FGc0pcL2dpZDliNGtJem5tRDBmRXpkd1dTQXN1TURrK0FVRDdBcEsxUVNpRlJBWG1wV2ErTSsiLCJtYWMiOiJmN2ZjNmRiZDczNjIxYWRiMmJkOWE3MDdmOTMxNmEwZjU2ZGMyYzNhMTI2ZTA3NWJiNjRmYTRlMWM5MzE1YTM5In0%3D';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Cookie: anyconvsession=' . $cookieValue]);
$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    echo "Error occurred while fetching data.";
} else {
    echo $response;
}



die;
// if ($_REQUEST['action'] == 'submit') {
    
// }
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
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($ch);
    $info = curl_getinfo($ch);
    echo '<pre>';
    print_r($info);
    echo '</pre>';
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