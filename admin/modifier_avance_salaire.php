<?php
	include 'includes/session.php';

	if(isset($_POST['modifier'])){
		$id = $_POST['id'];
		$montant = $_POST['montant'];
		
		$sql = "UPDATE avance_salaire SET montant = '$montant' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'avance sur salaire enregistrée!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'veillez remplir tous les champs!';
	}

	header('location:avance_salaire.php');

?>