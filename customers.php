<?php
error_reporting(E_ALL ^ E_WARNING);

include'dbconfig.php';

$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://tonewells.com/emerald/wp-json/wc/v2/customers",
  CURLOPT_RETURNTRANSFER => true,
  
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",

  CURLOPT_HTTPHEADER => array(
   "authorization: Basic Y2tfNjVlOGNkNjBlYWNhMmJkNGU2ZTU5ZGQ1MmFmM2VlN2QyZTg2ZGZjNTpjc182NzIwZTgzNGVjMTVjYmY1Zjg5Mzg0NzM5MTU4MDE5NDRkN2UwMTEx",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: a47e985d-1a2b-9e51-063d-1babdeba3696"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
 // echo $response;
}
$data=json_decode($response,true);
foreach ($data as $key => $value){
    $id = $value['id'];
    $first_name = $value['billing']['first_name'];
    $last_name = $value['billing']['last_name'];
    $email = $value['billing']['email'];
    $phone = $value['billing']['phone'];
    $company = $value['billing']['company'];
    
    $check        = mysqli_query($con, "select * from tbl_customer where c_id = '$id'");
   if (mysqli_num_rows($check) > 0) {
      //  echo "Record exists in products ";
   } else {
       
       $curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt_array($curl, array(
    
  CURLOPT_URL => "https://api.greenbits.com/api/v1/customers",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n  \"customer\": {\r\n    \"first_name\": \"$first_name\",\r\n    \"last_name\": \"$last_name\",\r\n    \"email\": \"$email\",\r\n    \"phone\": \"$phone\",\r\n    \r\n    \"company_id\": \"2b349e9a-2fab-4e58-aee0-4987f3dbaa56\"\r\n  }\r\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Token token=\"-NL6FcliNu8FGNpRt2qbJQ\"",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 541d79ac-e250-dc90-bbd7-1a33cc94294f",
    "x-gb-companyid: 2b349e9a-2fab-4e58-aee0-4987f3dbaa56"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
}

$query  = "INSERT INTO tbl_customer (c_id , first_name , last_name ,email , phone , company_id) VALUES  ('$id ','$first_name ','$last_name', '$email','$phone','$company')";
    
       $result = mysqli_query($con, $query);
       if ($result) {
          // echo "<div class='form'><h3> successfully added in products .</h3><br/></div>";
       } else {
          // echo "Error Inserting Data in products ";
       }



}
    
}
?>