<?php
	include 'includes/session.php';

	if(isset($_POST['supprimer'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM direction WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Direction supprimée avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'veillez selectionner l\'item';
	}

	header('location: direction.php');
	
?>