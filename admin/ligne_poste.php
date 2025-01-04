<?php 
	include 'includes/session.php';

	if(isset($_POST['id_poste'])){ // Vérifiez que c'est bien 'id_poste'
		$id = $_POST['id_poste'];
		$sql = "SELECT * FROM poste WHERE id_poste = '$id'";
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
