<?php
if (isset($_GET['param1'])) {
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'loginregister');
 $product_id=$_GET['param1'];
 
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 $stmt = $conn->prepare("SELECT product_shop.shop_id,product_shop.price,product_shop.specialOffers,shop.name,shop.latitude,shop.longitude FROM product_shop INNER JOIN shop ON product_shop.shop_id=shop.shop_id WHERE product_id=$product_id");

 
 $stmt->execute();
 
 $stmt->bind_result($shop_id, $price, $specialOffers, $name, $latitude, $longitude);
 
 $shops = array(); 
 
 while($stmt->fetch()){
 $temp = array(); 
 $temp['shop_id'] = $shop_id; 
 $temp['price'] = $price; 
 $temp['specialOffers'] = $specialOffers;
 $temp['name'] = $name;
 $temp['latitude'] = $latitude;
 $temp['longitude'] = $longitude;
 array_push($shops, $temp);
 }
 
 echo json_encode($shops);
}else{
	echo "Product_ID is Required";
}
?>
