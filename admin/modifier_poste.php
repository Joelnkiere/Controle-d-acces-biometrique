<?php
	include 'includes/session.php';

	if(isset($_POST['modifier'])){
		$id = $_POST['id'];
		$nom_poste = $_POST['nom_poste'];
        $direction = $_POST['direction'];
		$salaire_parHeure1=$_POST['salaire_parHeure'];
		$salaire_parHeure=str_replace("'","\'",$salaire_parHeure1);

		error_log("Modifier Poste: ID = $id, Nom = $nom_poste, Direction = $direction, salaire_parHeure=$salaire_parHeure"); // Log des données reçues

		if (!empty($id) && !empty($nom_poste) && !empty($direction)&& !empty($salaire_parHeure)) {
			$sql = "UPDATE poste SET titre = '$nom_poste', id_direction='$direction', salaire_parHeure='$salaire_parHeure' WHERE id_poste = '$id'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Poste modifié avec succès!';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		} else {
			$_SESSION['error'] = 'Veuillez remplir tous les champs.';
		}
	} else {
		$_SESSION['error'] = 'Veuillez bien remplir les champs.';
	}

	header('location: poste.php');
?>
