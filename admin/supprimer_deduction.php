<?php
	include 'includes/session.php';

	if(isset($_POST['supprimer'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM deduction_salaire WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Deduction supprimée avec succè!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Veillez selectionner un enregistrement!';
	}

	header('location: deduction.php');
	
?>