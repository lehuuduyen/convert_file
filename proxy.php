<?php
$randomString = (isset($_GET['random']))?$_GET['random']:"";
$header = (isset(getallheaders()['Cookie']))?getallheaders()['Cookie']:"";
$url = 'https://anyconv.com/api/action/download/'.$randomString;
$cookieValue = $header;
if($cookieValue !=""){
    $listCookie = explode(';',$cookieValue);
    $cookieValue = "";
    foreach($listCookie as $value){
        if(preg_match("/anyconvsession/i", $value)){
            $cookieValue = $value;
        }
    }
}

$url = 'https://anyconv.com/api/action/download/nXrXDvUN8obxmlciIvb7CHNjXjx2T3bv/';
$cookieValue = 'eyJpdiI6IjRaRjRvd0hzQVh0WGxhT2FYUXFRZnc9PSIsInZhbHVlIjoiTFZrRWlGeTFKYzJkMzc1QU9yZFREUzZhTDFaSEczOVpPdmhXdk5qT2xmT21ZNnZLODFxNG9BeU9qdEUxV1lLXC8iLCJtYWMiOiJmNjVlYjYzODZlOTlkYWE3NjcxOWE3NjUxY2Y3OTg5MmI4ODk3Nzg5YThjYTZjZTliZmZmZTI5ZjcxZWZlNDZkIn0%3D';

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

// The URL you want to access via the proxy
$targetUrl = 'https://anyconv.com/api/action/download/' . $randomString;

// Initialize cURL session
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $targetUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow any redirects
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'); // Set a User-Agent header

// Execute the cURL session and get the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    // Handle errors if necessary
    echo 'Error: ' . curl_error($ch);
}

// Close the cURL session
curl_close($ch);

// Enable CORS for all domains (*). You can set a specific domain instead.
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); // Adjust the allowed methods
header('Access-Control-Allow-Headers: Content-Type'); // Add more headers if needed
header('Access-Control-Allow-Credentials: true'); // Adjust the Content-Type based on the response type
echo $response;