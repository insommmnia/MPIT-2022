<?php session_start(); ?>
<?php

	$img_dir = '../imgs/';
	$img_name = $img_dir.basename($_FILES['img']['name']);
	$upload = move_uploaded_file($_FILES['img']['tmp_name'], $img_name);

	$connect = mysqli_connect("j47246945.myjino.ru","j47246945","nikitka20041616","j47246945");
      
	$text_query = "SELECT * FROM users WHERE id = '{$_SESSION['id']}'";
 	$query = mysqli_query($connect, $text_query);
 	$result = $query->fetch_assoc();
 	 $namee = "".$result["name"]."  ".$result["surname"]."";
    
   

	
  $text_zaprosa_vstavit = "INSERT INTO suggestions (name, descr, place, author, img)
            VALUES
            ('{$_POST["name"]}', 
            '{$_POST["descr"]}',
            '{$_POST["place"]}',
        	'{$namee}',
        	'{$img_name}')";
  $query_insert = mysqli_query($connect, $text_zaprosa_vstavit);
  

header('Location: ../admin.php');
	

	
	
?>