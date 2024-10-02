<?php
	include 'includes/session.php';

	if(isset($_POST['modifier'])){
		$id1 = $_POST['id'];
		$id=str_replace("'","\'",$id1);

		$libelle1 = $_POST['libelle'];
		$libelle=str_replace("'","\'",$libelle1);
		

		$sql = "UPDATE direction SET libelle = '$libelle' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Direction modifiée avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'veillez bien remplsir les champs';
	}

	header('location:direction.php');

?>