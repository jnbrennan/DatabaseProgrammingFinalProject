<?php 
// Start the session
session_start();

$lsGet = $_GET;
if (!isset($lsGet['status']))
{
    $lsGet['status'] = " ";
}
$status = $lsGet['status']; 
unset($lsGet['status']);


if (!isset($lsGet['biid']))
{
    $lsGet['biid'] = " ";
}
$biid = $lsGet['biid']; 
unset($lsGet['biid']);


if (!isset($lsGet['borrowed']))
{
    $lsGet['borrowed'] = " ";
}
$borrowed = $lsGet['borrowed']; 
unset($lsGet['borrowed']);


include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

//if not yet logged in, send to login page
if(!isset($_SESSION['username']) or empty($_SESSION['username']))
{
   header("Location: login.php");
} 

try
{
	$books = $pdo->query("SELECT *
						 FROM book
						 WHERE username='{$_SESSION['username']}'
						 AND bookid=$biid");
	
	if ($borrowed==1) 
	{
		header('Location:manage_books.php?error=Cannot deactivate borrowed book.');
		exit();
	}
	else
	{
		if ($status=="Deactivate") 
		{
			$deactivate = $pdo->query("UPDATE book SET active=0 WHERE bookid=$biid");
			header('Location:manage_books.php?error=Successfully deactivated book.');
			exit();
		}
		else if ($status=="Activate")
		{
			$activate = $pdo->query("UPDATE book SET active=1 WHERE bookid=$biid");
			header('Location:manage_books.php?error=Successfully activated book.');
			exit();
		}
		else
		{
			header('Location:manage_books.php?error=Error fetching active status.');
			exit();
		}
	}			 
}
catch (PDOException $e)
{
	header('Location:manage_books.php?error=Database error selecting from book.');
    exit();
}
?>