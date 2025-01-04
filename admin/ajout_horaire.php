<?php
	include 'includes/session.php';

	if(isset($_POST['ajouter'])){
		$heure_entree = $_POST['heure_entree'];
		$heure_entree = date('H:i:s', strtotime($heure_entree));
		$heure_sortie = $_POST['heure_sortie'];
		$heure_sortie = date('H:i:s', strtotime($heure_sortie));

		$sql = "INSERT INTO horaire (heure_entree, heure_sortie) VALUES ('$heure_entree', '$heure_sortie')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Horaire ajouter avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'veillez remplir tous les champs';
	}

	header('location: horaire.php');

?>