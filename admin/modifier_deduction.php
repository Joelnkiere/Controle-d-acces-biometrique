<?php
	include 'includes/session.php';

	if(isset($_POST['modifier'])){
		$id = $_POST['id'];
		$motif = $_POST['motif'];
		$montant = $_POST['montant'];

		$sql = "UPDATE deduction_salaire SET motif = '$motif', montant = '$montant' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Deduction modifiée avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Veillez selectionner un iteme!';
	}

	header('location:deduction.php');

?>