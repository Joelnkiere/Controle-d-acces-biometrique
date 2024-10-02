<?php 
	include 'includes/session.php';

	if(isset($_POST['id_service'])){ // Vérifiez que c'est bien 'id_service'
		$id = $_POST['id_service'];
		$sql = "SELECT * FROM service WHERE id_service = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		if ($row) {
			echo json_encode($row);
		} else {
			echo json_encode(['error' => 'No record found.']);
		}
	} else {
		echo json_encode(['error' => 'ID not set.']);
	}
?>
