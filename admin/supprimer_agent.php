<?php
	include 'includes/session.php';

	if(isset($_POST['supprimer'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM agent WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Agent supprimer avec succes!';
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