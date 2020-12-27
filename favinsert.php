<?php

 if (isset($_GET['param1'], $_GET['param2'], $_GET['param3'])) {
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_NAME', 'loginregister');
	
	$email=$_GET['param1'];
	$shop_id=$_GET['param2'];
	$product_id=$_GET['param3'];
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die();
	}
	$result=mysqli_query($conn,"SELECT id FROM `product_shop` WHERE product_id=$product_id AND shop_id=$shop_id");
	$id=mysqli_fetch_assoc($result);
	$product_shop_id=$id['id'];
	$conn -> close();
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	die();
	}
	
	$result=mysqli_query($conn,"SELECT id FROM `users` WHERE email=$email");
	$id=mysqli_fetch_assoc($result);
	$user_id=$id['id'];
	
	$result = mysqli_query($conn,"SELECT `id`FROM `fav` WHERE `user_id`=$user_id AND `product_shop_id`=$product_shop_id");
	$num_rows = mysqli_num_rows($result);
	

	
	if($num_rows > 0){
		echo "Already in favourites";
		
	}else{
		$stmt=$conn->prepare("INSERT INTO `fav`(`user_id`, `product_shop_id`, `shop_id`, `product_id`) VALUES ($user_id, $product_shop_id, $shop_id, $product_id)");
		$stmt->execute();
		echo "Added to favourites";
	}
	

 }else{
	echo "All fields are Required"; 
 }

?>