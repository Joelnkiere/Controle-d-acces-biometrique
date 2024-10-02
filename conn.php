<?php
	$conn = new mysqli('localhost', 'root', '', 'bcc_security');

	if ($conn->connect_error) {
	    die("connexion echouée: " . $conn->connect_error);
	}
	
?>