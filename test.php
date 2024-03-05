<?php

const USERNAME = "EshopMime";
const PASSWORD = "-zde dopln heslo-";


$url = 'https://k2.schindler.cz/SWSORI/Meta/FullVersion';
$hash = getAuthorizationHeader(PASSWORD, $url);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
$headers = [
    'Authorization' => USERNAME . ':' . $hash
];
echo "--- Headers -----\n";
var_dump($headers);
echo "--- Headers -----\n";
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
$info = curl_getinfo($curl);

$error_no = curl_errno($curl);
if ($error_no) {
    $error_msg = curl_error($curl);
    echo "\n\n\ERROR: $error_no $error_msg\n\n";
}

echo "--- cURL Info -----\n";
var_dump($info);
echo "--- cURL Info -----\n";
curl_close($curl);
echo "\n\nRESPONSE: $response\n\n";


/**
 * Toto je z dokumentace https://help.k2.cz/k2ori/04/cs/107668.htm#o128814
 */
function getAuthorizationHeader($password, $fullUrl)
{
    return base64_encode(hash_hmac('md5', mb_strtoupper(rawurldecode($fullUrl), 'UTF-8'), $password, true));
}