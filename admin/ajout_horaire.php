<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$heure_entree = $_POST['heure_entree'];
		$heure_entree = date('H:i:s', strtotime($heure_entree));
		$heure_sortie = $_POST['heure_sortie'];
		$heure_sortie = date('H:i:s', strtotime($heure_sortie));

		$sql = "INSERT INTO horaire (heure_entree, heure_sortie) VALUES ('$heure_entree', '$heure_sortie')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Schedule added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: horaire.php');

?>