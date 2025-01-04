<?php
	include 'includes/session.php';

	if(isset($_POST['modifier'])){
		$id = $_POST['id'];
		$heure_entree = $_POST['heure_entree'];
		$heure_entree = date('H:i:s', strtotime($heure_entree));
		$heure_sortie = $_POST['heure_sortie'];
		$heure_sortie = date('H:i:s', strtotime($heure_sortie));

		$sql = "UPDATE horaire SET heure_entree = '$heure_entree', heure_sortie = '$heure_sortie' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Horaire modifié avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'veillez selectionner un iteme!';
	}

	header('location:horaire.php');

?>