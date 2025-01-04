<?php
	include 'includes/session.php';

	if(isset($_POST['supprimer'])){
		$id = $_POST['id'];

		// Ajoutez un log pour vérifier l'ID
		error_log("Supprimer Service: ID = $id");

		if (!empty($id)) {
			$sql = "DELETE FROM poste WHERE id_poste = '$id'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Service supprimé avec succès!';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		} else {
			$_SESSION['error'] = 'Veuillez sélectionner l\'item.';
		}
	} else {
		$_SESSION['error'] = 'Veuillez sélectionner l\'item.';
	}

	header('location: poste.php');
?>
