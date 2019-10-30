<?php

$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://tonewells.com/emerald/wp-json/wc/v2/customers/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n  \"email\": \"johnddd.doe@example.com\",\r\n  \"first_name\": \"John\",\r\n  \"last_name\": \"Doe\",\r\n  \"username\": \"john.doe\",\r\n  \"password\": \"hello\",\r\n  \"billing\": {\r\n    \"first_name\": \"John\",\r\n    \"last_name\": \"Doe\",\r\n    \"company\": \"\",\r\n    \"address_1\": \"969 Market\",\r\n    \"address_2\": \"\",\r\n    \"city\": \"San Francisco\",\r\n    \"state\": \"CA\",\r\n    \"postcode\": \"94103\",\r\n    \"country\": \"US\",\r\n    \"email\": \"johnddd.doe@example.com\",\r\n    \"phone\": \"(555) 555-5555\"\r\n  },\r\n  \"shipping\": {\r\n    \"first_name\": \"John\",\r\n    \"last_name\": \"Doe\",\r\n    \"company\": \"\",\r\n    \"address_1\": \"969 Market\",\r\n    \"address_2\": \"\",\r\n    \"city\": \"San Francisco\",\r\n    \"state\": \"CA\",\r\n    \"postcode\": \"94103\",\r\n    \"country\": \"US\"\r\n  }\r\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Basic Y2tfNjVlOGNkNjBlYWNhMmJkNGU2ZTU5ZGQ1MmFmM2VlN2QyZTg2ZGZjNTpjc182NzIwZTgzNGVjMTVjYmY1Zjg5Mzg0NzM5MTU4MDE5NDRkN2UwMTEx",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: e5b2bd7c-695f-9c2f-3fd5-fa7809352b33"
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