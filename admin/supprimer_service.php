
<?php
	/*include 'includes/session.php';

	if(isset($_POST['supprimer'])){
		$id = $_POST['id'];
		
		if (!empty($id)) {
			$sql = "DELETE FROM service WHERE id_service = '$id'";
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

	header('location: service.php');*/
?>



<?php
	include 'includes/session.php';

	if(isset($_POST['supprimer'])){
		$id = $_POST['id'];

		// Ajoutez un log pour vérifier l'ID
		error_log("Supprimer Service: ID = $id");

		if (!empty($id)) {
			$sql = "DELETE FROM service WHERE id_service = '$id'";
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

	header('location: service.php');
?>
