<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://mybusiness.googleapis.com/v4/accounts/100928649975105038548/locations",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; comment=\r\n\r\ndsfsasadasdsadasdsa\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ya29.Gls5BjmxmaO53QJIPnc8JCD0EWAucnTOyC4eFSUGpsgQ6oE1Qr8c2Dg8PJxTg4BrEkAW-m8uQZAbLDc3KkYS3iBRkdWhTOUNu8juNcpYGFBuEP-FiqYMaf1YzhzJ",
    "Cache-Control: no-cache",
    
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}