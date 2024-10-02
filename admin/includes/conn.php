<?php
	$conn = new mysqli('localhost', 'root', '', 'bcc_security');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>