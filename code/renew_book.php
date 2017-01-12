<?php
// Start the session
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

//if not yet logged in, send to login page
if(!isset($_SESSION['username']) or empty($_SESSION['username']))
{
   header("Location: login.php");
}

if (!isset($_POST['renew']))
{
$biid = $_POST['bookid'];
$numdays = 7;

	try
	{
		$pdo->beginTransaction();

		//set book to returned
		$query0 = "UPDATE book SET borrowed=0 WHERE bookid=$biid";
		$q0 = $pdo->query($query0);

		$query1 = "SELECT COUNT(*) FROM bookorder";
		$q1 = $pdo->query($query1);

		$row = $q1->fetch();
		if ($row[0] < 1)
		{ //bookorder table is empty, set initial value
			$query2 = "ALTER TABLE bookorder AUTO_INCREMENT=100000001";
			$q2 = $pdo->query($query2);
		}

		//insert bookorder info
		$query4 = "INSERT INTO bookorder(orderdate, duration, username)
					values(now(), $numdays, '{$_SESSION['username']}')";
		$q4 = $pdo->query($query4);

		//grabbing orderid
		$query3 = "SELECT MAX(orderid) as orderid FROM bookorder";
		$q3 = $pdo->query($query3);
		$orderid = $q3->fetch();

		//insert orderhistory
		$query5 = "INSERT INTO orderhistory(orderid, bookid, duedate)
					values($orderid[0],
						$biid;
						date_add(CURDATE(), INTERVAL $numdays DAY))";
		$q5 = $pdo->query($query5);

		//set book to borrowed
		$query6 = "UPDATE book SET borrowed=1 WHERE bookid=$biid";
		$q6 = $pdo->query($query6);

		$pdo->commit();
	}
	catch (PDOException $e)
	{
		$pdo->rollback();
		header('Location: book_info.php?error=Error borrowing book.');
	}

}

?>
