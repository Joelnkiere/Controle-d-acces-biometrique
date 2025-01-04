<?php
	include 'includes/session.php';

	if(isset($_POST['ajouter'])){
		$motif = $_POST['motif'];
		$montant = $_POST['montant'];

		$sql = "INSERT INTO deduction_salaire (motif, montant) VALUES ('$motif', '$montant')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Deduction ajoutée avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'veillez remplir tous les champs';
	}

	header('location: deduction.php');

?>