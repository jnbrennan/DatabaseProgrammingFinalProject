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
	$books = $pdo->query("SELECT DISTINCT bo.orderid, b.bookid, b.username as ousername, bo.username as borrower, b.title, b.afirstname,
							b.alastname, bo.orderdate, oh.duedate
						FROM book as b, bookorder as bo, orderhistory as oh
						WHERE b.bookid=oh.bookid
						AND bo.orderid=oh.orderid
						ORDER BY oh.orderid DESC");

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
    <title>ABorrowHistory</title>
</head>

<body>
  <!-- logout button on the upper right corner of the screen -->
  <div style="position:absolute; top:0; right:0;">
      <input type="button" name="logout" id="logout "value="logout" onclick="window.location.href='logout.php'" style="background-color:maroon">
  </div>
  <center>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <h2>Borrow History</h2>
    <p>Below is a list of all books borrowed.</p>
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
    	<td><font color="white">Owner Username</font></td>
    	<td><font color="white">Borrower Username</font></td>
    	<td><font color="white">Title</font></td>
    	<td><font color="white">Author</font></td>
    	<td><font color="white">Order Date</font></td>
    	<td><font color="white">Due Date</font></td>
    </tr>
    <?php foreach ($books as $book):
    	$orderid = $book['orderid'];
    	$bookid = $book['bookid'];
    	$ousername = $book['ousername'];
    	$borrower = $book['borrower'];
    	$title = $book['title'];
    	$afirstname = $book['afirstname'];
    	$alastname = $book['alastname'];
    	$orderdate = $book['orderdate'];
    	$duedate = $book['duedate'];
	?>
    	<tr bgcolor="#E59F15">
    		<td> <?php echo $orderid; ?> </td>
    		<td> <?php echo $bookid; ?> </td>
    		<td> <?php echo $ousername; ?> </td>
    		<td> <?php echo $borrower; ?> </td>
    		<td> <?php echo $title; ?> </td>
    		<td> <?php echo "$afirstname $alastname"; ?> </td>
    		<td> <?php echo $orderdate; ?> </td>
    		<td> <?php echo $duedate; ?> </td>
    	</tr>
    <?php endforeach; ?>
    </table>

    <p><a href="admin_home.php">Go back to homepage</a></p>
    <?php include_once "googletranslator.php"; ?>
    </center>
</body>

</html>
