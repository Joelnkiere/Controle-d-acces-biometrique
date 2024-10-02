<?php
	include 'includes/session.php';

	if(isset($_POST['modifier'])){
		$id = $_POST['id'];
		$nom_service = $_POST['nom_service'];
        $direction = $_POST['direction'];

		error_log("Modifier Service: ID = $id, Nom = $nom_service, Direction = $direction"); // Log des données reçues

		if (!empty($id) && !empty($nom_service) && !empty($direction)) {
			$sql = "UPDATE service SET nom_service = '$nom_service', id_direction='$direction' WHERE id_service = '$id'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Service modifié avec succès!';
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

	header('location: service.php');
?>
