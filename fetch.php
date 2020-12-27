<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['email'])) {
	if ($db->dbConnect()) {
		echo $db->fetchName("users",$_POST['email']);
	} else echo "Error: Database connection";
}
?>