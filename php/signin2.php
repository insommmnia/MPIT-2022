<?php session_start(); ?>
<?php  

	$con = mysqli_connect("j47246945.myjino.ru","j47246945","nikitka20041616","j47246945");
	$text_query = "SELECT * FROM users WHERE mail = '{$_GET["email"]}' ";
	
	$query = mysqli_query($con, $text_query);
 	$result = $query->fetch_assoc();






 	$_SESSION['id'] = $result['id'];
 	header('Location: ../posts.php');

?>