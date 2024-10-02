<?php
	include 'includes/session.php';

	if(isset($_POST['enregistrer'])){
		$nom_service1 = $_POST['nom_service'];
		$nom_service= str_replace("'","\'",$nom_service1);

		$direction1=$_POST['direction'];
		$direction=str_replace("'","\'",$direction1);

		$sql = "INSERT INTO service (nom_service, id_direction) VALUES ('$nom_service','$direction')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Service enregistré avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'veillez bien remplir les champs';
	}

	header('location: service.php');

?>