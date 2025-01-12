<?php
	// Dans le fichier session.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Démarre la session uniquement si aucune session n'est active
}

	include 'includes/conn.php';

	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
		header('location: index.php');
	}

	$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['admin']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
	
?>