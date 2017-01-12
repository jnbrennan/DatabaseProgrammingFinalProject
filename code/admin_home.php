<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';

// Start the session
session_start();

//if not yet logged in, send to login page
if(!isset($_SESSION['username']) or empty($_SESSION['username']))
{
   header("Location: login.php");
}

try
{
	$books = $pdo->query('SELECT DISTINCT bo.orderid, bo.username as busername, b.bookid, b.title,
							b.username as ousername, oh.duedate, datediff(CURDATE(), oh.duedate) as exceededdays
						FROM book as b, bookorder as bo, orderhistory as oh
						WHERE b.bookid=oh.bookid
						AND bo.orderid=oh.orderid
						AND b.borrowed=1
						AND duedate<CURDATE()');
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
    <title>AdminHome</title>
</head>

<body>
  <!-- logout button on the upper right corner of the screen -->
  <div style="position:absolute; top:0; right:0;">
      <input type="button" name="logout" id="logout "value="logout" onclick="window.location.href='logout.php'" style="background-color:maroon">
  </div>

  <center>
	<IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <h2>Welcome Admin!</h2>
    <p><a href="verify_user.php">Verify Users</a>&nbsp;&nbsp;&nbsp;
    <a href="delete_admin.php">Delete Admins</a>&nbsp;&nbsp;&nbsp;
    <a href="stats.php">Statistics</a></p>
    <br>

    <style>
    table,th,td
    {
    border:1px solid black;
    }
    </style>
    <p>List of Overdue Books:</p>
    <table>
    <tr bgcolor="#B22C4F">
    	<td><font color="white">Order ID</font></td>
    	<td><font color="white">Borrower</font></td>
    	<td><font color="white">Book ID</font></td>
    	<td><font color="white">Book Title</font></td>
    	<td><font color="white">Owner</font></td>
    	<td><font color="white">Due Date</font></td>
    	<td><font color="white">Exceeded Days</font></td>
    </tr>
	<?php foreach ($books as $book):
    	$orderid = $book['orderid'];
    	$busername = $book['busername'];
    	$bookid = $book['bookid'];
    	$title = $book['title'];
    	$ousername = $book['ousername'];
    	$duedate = $book['duedate'];
    	$exceededdays = $book['exceededdays'];
	?>
    	<tr bgcolor="#E59F15">
    		<td> <?php echo $orderid; ?> </td>
    		<td> <?php echo $busername; ?> </td>
    		<td> <?php echo $bookid; ?> </td>
    		<td> <?php echo $title; ?> </td>
    		<td> <?php echo $ousername; ?> </td>
    		<td> <?php echo $duedate; ?> </td>
    		<td> <?php echo $exceededdays; ?> </td>
    	</tr>
    <?php endforeach; ?>
    </table>

    
    <?php include_once "googletranslator.php"; ?>

  </center>
</body>
</html>
