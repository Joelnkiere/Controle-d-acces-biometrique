<?php
	include 'includes/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];
		
	}
	else{
		$return = 'home.php';
	}

	if(isset($_POST['enregistrer'])){
		$curr_password1 = $_POST['curr_password'];
		$curr_password=str_replace("'","\'",$curr_password1);

		$username1 = $_POST['username'];
		$username=str_replace("'","\'",$username1);

		$password1 = $_POST['password'];
		$password=str_replace("'","\'",$password1);

		$prenom1 = $_POST['prenom'];
		$prenom=str_replace("'","\'",$prenom1);

		$nom1 = $_POST['nom'];
		$nom=str_replace("'","\'",$nom1);
		
		$photo = $_FILES['photo']['name'];
		if(password_verify($curr_password, $user['password'])){
			if(!empty($photo)){
				$photo = rand().$_FILES['photo']['name'];
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$photo);
				$filename = $photo;	
			}
			else{
				$filename = $user['photo'];
			}

			if($password == $user['password']){
				$password = $user['password'];
			}
			else{
				$password = password_hash($password, PASSWORD_DEFAULT);
			}

			$sql = "UPDATE admin SET username = '$username', password = '$password', prenom = '$prenom', nom = '$nom', photo = '$filename' WHERE id = '".$user['id']."'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Profile Mis à jour!';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
			
		}
		else{
			$_SESSION['error'] = 'Mot de passe incorrect!';
		}
	}
	else{
		$_SESSION['error'] = 'Remplissez tous les champs';
	}

	header('location:'.$return);

?>