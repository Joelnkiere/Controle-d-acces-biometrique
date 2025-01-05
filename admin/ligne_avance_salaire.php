<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, avance_salaire.id AS caid FROM avance_salaire LEFT JOIN agent on agent.id=avance_salaire.id_agent WHERE avance_salaire.id='$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>