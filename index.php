<?php

  $p_id= 0;
        $name= 0;
        $sell_price= 0;
        $quantity= 0;
        $vendor=0;
        $latest_sku= 0;
        $description= 0;

		include 'dbconfig.php';
$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt_array($curl, array(
 CURLOPT_URL => "https://api.greenbits.com/api/v1/products",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => "",
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 30,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "GET",
 CURLOPT_HTTPHEADER => array(
    "authorization: Token token=\"-NL6FcliNu8FGNpRt2qbJQ\"",
   "cache-control: no-cache",
   "content-type: application/json",
   "postman-token: 03c0d4fc-dedf-e964-36ef-b1731fc61113",
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


$data= json_decode($response,true);

    
    foreach($data['products'] as $key => $value)
    
    {
        $p_id= $value['id'];
        $name= $value['name'];
        $sell_price= $value['sell_price'];
        $quantity= $value['quantity'];
        $vendor= $value['vendor'];
        $latest_sku= $value['latest_sku'];
        $description= $value['description'];
		
        
 $check        = mysqli_query($con, "select * from tbl_data where sku = '$p_id'");
   if (mysqli_num_rows($check) > 0) {
       
       
       $sql=mysqli_query($con, "select * from tbl_data"); 
$woo_id=0;
while($row= mysqli_fetch_array($sql)) {
    
 $woo_id        =       $row[1];   
}
   // echo $woo_id;
    
 
$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

$url ="https://tonewells.com/emerald/wp-json/wc/v2/products/";

$url .= $woo_id;

curl_setopt_array($curl, array(
  CURLOPT_URL => "$url",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS => "{\r\n  \"name\":\"$name\",\r\n  \"description\":\"$description\",\r\n  \"stock_quantity\":\"$quantity\" ,\r\n  \"regular_price\": \"$sell_price\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "authorization: Basic Y2tfNjVlOGNkNjBlYWNhMmJkNGU2ZTU5ZGQ1MmFmM2VlN2QyZTg2ZGZjNTpjc182NzIwZTgzNGVjMTVjYmY1Zjg5Mzg0NzM5MTU4MDE5NDRkN2UwMTEx",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: e221bc3e-a759-8da4-668a-6a045a4225cb"
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
    
    
    
    
    
    
           //  echo "Record exists in products ";
   } else {
       
       
$curl = curl_init();

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://tonewells.com/emerald/wp-json/wc/v2/products",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n  \"name\": \"$name\",\r\n  \"type\": \"simple\",\r\n  \"stock_quantity\": $quantity ,  \"regular_price\": \"$sell_price\",\r\n  \"description\": \"$description\",\r\n  \r\n   \"sku\": \"$latest_sku\",\r\n  \"categories\": [\r\n    {\r\n      \"id\": 160\r\n    }\r\n   \r\n  ]\r\n}",
  CURLOPT_HTTPHEADER => array(
     "authorization: Basic Y2tfNjVlOGNkNjBlYWNhMmJkNGU2ZTU5ZGQ1MmFmM2VlN2QyZTg2ZGZjNTpjc182NzIwZTgzNGVjMTVjYmY1Zjg5Mzg0NzM5MTU4MDE5NDRkN2UwMTEx",
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: 29ce7988-16cd-52f1-2b5d-5cb994c34a78"
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
       
$decode1 = json_decode($response,true);


    $wooid =  $decode1['id'];         
      
      echo $wooid;

$query  = "INSERT INTO tbl_data (wooid , sku) VALUES  ('$wooid','$p_id')";
    
       $result = mysqli_query($con, $query);
       if ($result) {
          // echo "<div class='form'><h3> successfully added in tbl_data .</h3><br/></div>";
       } else {
          // echo "Error Inserting Data in tbl_data ";
       }



	} 
	}
	
	
   
	


?>