<?php
// Start the session
session_start();


include $_SERVER['DOCUMENT_ROOT'].'/projecttest/includes/db.inc.php';

//if not yet logged in, send to login page
if(!isset($_SESSION['username']) or empty($_SESSION['username']))
{
   header("Location: login.php");
}

if (isset($_POST['borrow']))
{
	$numdays = trim($_POST['numdays']);
	$biid = trim($_POST['biid']);
	echo var_dump($biid);
	echo var_dump($numdays);

	try {
		$pdo->beginTransaction();

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
						$biid,
						date_add(curdate(), INTERVAL $numdays DAY))";
		$q5 = $pdo->query($query5);

		//set book to borrowed
		$query6 = "UPDATE book SET borrowed=1 WHERE bookid=$biid";
		$q6 = $pdo->query($query6);

		$pdo->commit();
		echo "Commit is done";
	}
	catch (PDOException $e)
	{
		$pdo->rollback();
		header('Location: book_info.php?error=Error borrowing book.');
	}

	$error = "You have successfully borrowed the book. Please coordinate pickup with the owner.";
	header("Location: borrow_book.php?error=$error");
}
else
{
	header('Location: book_info.php?error=Please input how many days you would like to borrow.');
}

?>
