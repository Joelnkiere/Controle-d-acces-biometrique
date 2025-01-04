<?php
	include 'includes/session.php';

	if(isset($_POST['enregistrer'])){
		$nom_poste1 = $_POST['nom_poste'];
		$nom_poste= str_replace("'","\'",$nom_poste1);

		$direction1=$_POST['direction'];
		$direction=str_replace("'","\'",$direction1);
		$salaire_parHeure1=$_POST['salaire_parHeure'];
		$salaire_parHeure=str_replace("'","\'",$salaire_parHeure1);

		$sql = "INSERT INTO poste (titre, id_direction,salaire_parHeure) VALUES ('$nom_poste','$direction','$salaire_parHeure')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Poste enregistré avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'veillez bien remplir les champs';
	}

	header('location: poste.php');

?>