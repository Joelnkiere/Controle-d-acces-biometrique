<?php
	include 'includes/session.php';

	if(isset($_POST['enregistrer'])){
		$prenom1 = $_POST['prenom'];
		$prenom=str_replace("'","\'",$prenom1);

		$nom1 = $_POST['nom'];
		$nom=str_replace("'","\'",$nom1);

		$adresse1 = $_POST['adresse'];
		$adresse=str_replace("'","\'",$adresse1);

		$date_naissance1 = $_POST['date_naissance'];
		$date_naissance=str_replace("'","\'",$date_naissance1);

		$telephone1 = $_POST['telephone'];
		$telephone=str_replace("'","\'",$telephone1);

		$sexe1 = $_POST['sexe'];
		$sexe=str_replace("'","\'",$sexe1);

		$direction1 = $_POST['direction'];
		$direction=str_replace("'","\'",$direction1);

		$service1=$_POST['service'];
		$service=str_replace("'","\'",$service1);

		$horaire1 = $_POST['horaire'];
		$horaire=str_replace("'","\'",$horaire1);
		

		$photo = $_FILES['photo']['name'];
		if (!empty($photo)) {
			$allowed_extensions = array('png', 'jpg', 'jpeg','PNG','JPG','JPEG');
			$photo_extension = pathinfo($photo, PATHINFO_EXTENSION);
			if (in_array($photo_extension, $allowed_extensions)) {
				$photo = rand() . $_FILES['photo']['name'];
				$tmp_photo = $_FILES['photo']['tmp_name'];
				$photo_path = '../images/' . $photo;
		
				// Déplacez le fichier temporaire
				move_uploaded_file($tmp_photo, $photo_path);
		
			} else {
				$_SESSION['error'] = 'Extension de fichier non autorisée';
				header('location: agent.php');
				exit;
			}
		}
		
		//creating employeeid
		$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		    $letters .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		$id_agent = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
		//
		$sql = "INSERT INTO agent (id_agent, prenom, nom, adresse, date_naissance, telephone, sexe, id_direction, id_horaire, photo, created_on, id_service) VALUES ('$id_agent', '$prenom', '$nom', '$adresse', '$date_naissance', '$telephone', '$sexe', '$direction', '$horaire', '$photo', NOW(), '$service')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Agent Enregistrer avec succes!';
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



