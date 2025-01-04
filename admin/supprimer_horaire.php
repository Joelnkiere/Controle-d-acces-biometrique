<?php
	include 'includes/session.php';

	if(isset($_POST['supprimer'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM horaire WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Horaire supprimé avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'veillez selectionner un iteme!';
	}

	header('location: horaire.php');
	
?>