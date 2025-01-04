<?php
	include 'includes/session.php';

	if(isset($_POST['modifier'])){
		$empid = $_POST['id'];
		
		$prenom = $_POST['prenom'];
		$nom = $_POST['nom'];
		$adresse = $_POST['adresse'];
		$date_naissance = $_POST['date_naissance'];
		$telephone = $_POST['telephone'];
		$sexe = $_POST['sexe'];
		$direction = $_POST['direction'];
		$service=$_POST['service'];
		$poste=$_POST['poste'];
		$horaire = $_POST['horaire'];
		
		$sql = "UPDATE agent SET prenom = '$prenom', nom = '$nom', adresse = '$adresse', date_naissance = '$date_naissance', telephone = '$telephone', sexe = '$sexe', id_direction = '$direction', id_horaire = '$horaire', id_service='$service', id_poste='$poste' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'information modifiée avec succes!';
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