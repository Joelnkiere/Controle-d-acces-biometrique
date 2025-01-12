<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$sched_id = $_POST['horaire'];
		
		$sql = "UPDATE agent SET id_horaire = '$sched_id' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Horaire modifié avec succès!';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'veillez selectionner l\'horaire à modifier!';
	}

	header('location: horaire_agent.php');
?>