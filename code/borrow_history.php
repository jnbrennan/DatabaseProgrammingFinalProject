<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';

session_start();

//if not yet logged in, send to login page
if(!isset($_SESSION['username']) or empty($_SESSION['username']))
{
   header("Location: login.php");
} 


try
{
	$books = $pdo->query("SELECT DISTINCT bo.orderid, b.bookid, b.title, b.afirstname, 
							b.alastname, bo.orderdate, oh.duedate
						FROM book as b, bookorder as bo, orderhistory as oh
						WHERE b.bookid=oh.bookid
						AND bo.orderid=oh.orderid
						AND bo.username='{$_SESSION['username']}'
						ORDER BY oh.orderid");	
											
}
catch (PDOException $e)
{
    $error = 'Database error selecting from book!';
    include 'error.html.php';
    exit();
}
?>

<html>
<head>
	<meta charset="utf-8">
    <title>BorrowHistory</title>
</head>
<center>
<body>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <h2>Borrow History</h2>
    <p>Below is a list of all books you have borrowed in the past.</p>
    <style>
    table,th,td
    {
    border:1px solid black;
    }
    </style>
    <table>
    <tr bgcolor="#A20046">
    	<td><font color="white">Order ID</font></td>
    	<td><font color="white">Book ID</font></td>
    	<td><font color="white">Title</font></td>
    	<td><font color="white">Author</font></td>
    	<td><font color="white">Order Date</font></td>
    	<td><font color="white">Due Date</font></td>
    </tr> 
    <?php foreach ($books as $book):
    	$orderid = $book['orderid'];
    	$bookid = $book['bookid'];
    	$title = $book['title'];
    	$afirstname = $book['afirstname']; 
    	$alastname = $book['alastname']; 
    	$orderdate = $book['orderdate'];
    	$duedate = $book['duedate'];
	?>
    	<tr bgcolor="#E59F15">
    		<td> <?php echo $orderid; ?> </td>
    		<td> <?php echo $bookid; ?> </td>
    		<td> <?php echo $title; ?> </td>
    		<td> <?php echo "$afirstname $alastname"; ?> </td>
    		<td> <?php echo $orderdate; ?> </td>
    		<td> <?php echo $duedate; ?> </td>
    	</tr>
    <?php endforeach; ?>
    </table>

    <p><a href="student_home.php">Go back to homepage</a></p>
</body>
</center>
</html>
