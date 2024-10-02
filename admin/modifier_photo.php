<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$empid = $_POST['id'];
		$photo = $_FILES['photo']['name'];
		if(!empty($photo)){
			$photo = rand().$_FILES['photo']['name'];
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$photo);	
		}
		
		$sql = "UPDATE agent SET photo = '$photo' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'La photo de l\'agent a été mise à jour!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Echec de l\'operation!';
	}

	header('location: agent.php');
?>