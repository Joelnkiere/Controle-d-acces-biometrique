<?php
	include 'includes/session.php';

	if(isset($_POST['enregistrer'])){
		$libelle1 = $_POST['libelle'];
		$libelle=str_replace("'","\'",$libelle1);
		

		$sql = "INSERT INTO direction (libelle) VALUES ('$libelle')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Direction enregistrer avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'veillez bien remplir les champs';
	}

	header('location: direction.php');

?>