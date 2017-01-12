<?php 
// Start the session
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

//if not yet logged in, send to login page
if(!isset($_SESSION['username']) or empty($_SESSION['username']))
{
   header("Location: login.php");
} 

if (isset($_POST['verify']))
{	
	try
	{
		$verify = $pdo->exec("UPDATE student SET verified=1 WHERE username='{$_POST['username']}'");
		header('Location:verify_user.php?error=Successfully verified user.');
		exit();
	}
	catch (PDOException $e)
	{
		header('Location:verify_user.php?error=Unable to verify user.');
    	exit();
	}
}
else
{
	header('Location:verify_user.php?error=Error.');
    exit();
}
?>