<?php require_once('includes/functions.php'); ?>
<?php 
	//Primero tienes que encontrar la $_SESSION
	session_start();
	// Unset all the session variables
	$_SESSION = array();
	//destruye las session cookies
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(), '', time()-20, '/');
	} 
	// Destroy the session
	session_destroy();
	redirect_to("login.php?logout=1");
?>