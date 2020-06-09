<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://mybusiness.googleapis.com/v3/accounts/100928649975105038548/locations/12481351387678745559/reviews/AIe9_BHR7p0hPy1flx1br0TYdEUB_bUhAv310bszroYjBUHc8jQlyDBE0UDGhJPqJ7p9yoERjED9Tp6SVv0lJAKpfC0Q2Du-kkFMilFS1zVQGtMtDQBp1p8/reply",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; comment=\r\n\r\ndsfsasadasdsadasdsa\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ya29.Glt5BYagU5nWyRcDntfmIRJ7TjaQcwTNB8Vpbt5xbFDKaP_qo5idsuaoGvPSSxn-HoYOHsyCgYI8n0eqSwHIhvwyPGFDE5gGiWLtm0v8lv-R9-PsGCOPDxXvp8ae",
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