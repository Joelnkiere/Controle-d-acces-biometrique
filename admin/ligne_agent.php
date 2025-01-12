<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, agent.id as empid FROM agent LEFT JOIN direction ON direction.id=agent.id_direction LEFT JOIN service on service.id_direction=direction.id LEFT JOIN poste on poste.id_poste=agent.id_poste LEFT JOIN horaire ON horaire.id=agent.id_horaire WHERE agent.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>