<?php
	include 'includes/session.php';

	if(isset($_POST['ajouter'])){
		$agent = $_POST['agent'];
		$montant = $_POST['montant'];
		
		$sql = "SELECT * FROM agent WHERE id_agent = '$agent'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Agent Introuvable!';
		}
		else{
			$row = $query->fetch_assoc();
			$id_agent = $row['id'];
			$nom_agent=$row['nom'].' '.$row['prenom'];
			$sql = "INSERT INTO avance_salaire (id_agent, date_avance, montant) VALUES ('$id_agent', NOW(), '$montant')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'l\'Agent '.$nom_agent.' a pris une avance!';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'veillez selecionner un agent!';
	}

	header('location: avance_salaire.php');

?>