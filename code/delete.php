<?php 
// Start the session
session_start();


include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

//if not yet logged in, send to login page
if(!isset($_SESSION['username']) or empty($_SESSION['username']))
{
   header("Location: login.php");
} 


if (!isset($_POST['delete']))
{
$username = $_POST['username'];
	
	if ($_SESSION['username'] == $username)
	{
		header('Location:delete_admin.php?error=You cannot delete yourself.');
	}
	
	try
	{
		$delete = $pdo->query("DELETE FROM administrator WHERE username='$username'");
		header('Location:delete_admin.php?error=Successfully deleted user.');
		exit();	
		
	}
	catch (PDOException $e)
	{
		header('Location:delete_admin.php?error=Error deleting user.');
		exit();	
	}
}

?>