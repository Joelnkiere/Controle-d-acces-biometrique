<?php
	include 'includes/session.php';

	if(isset($_POST['supprimer'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM avance_salaire WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Avance annulée avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'veillez selectionner un iteme!';
	}

	header('location: avance_salaire.php');
	
?>