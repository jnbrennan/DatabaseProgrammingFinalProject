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
	$books = $pdo->query("SELECT DISTINCT b.bookid as biid, b.title, b.afirstname, b.alastname, b.isbn, oh.duedate
						 FROM book as b, orderhistory as oh, bookorder as bo
						 WHERE b.bookid=oh.bookid
						 AND bo.orderid=oh.orderid
						 AND bo.username='{$_SESSION['username']}'
						 AND borrowed=1
						 AND duedate>CURDATE()
						 ORDER BY duedate");
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
    <title>StudentHome</title>
</head>

<body>
  <!-- logout button on the upper right corner of the screen -->
  <div style="position:absolute; top:0; right:0;">
      <input type="button" name="logout" id="logout "value="logout" onclick="window.location.href='logout.php'" style="background-color:maroon">
  </div>
  <center>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <h2>Welcome Student!</h2>
    <p><a href="add_book.php">Add A Book</a>&nbsp;&nbsp;&nbsp;
    <a href="manage_books.php">Manage Your Books</a>&nbsp;&nbsp;&nbsp;
    <a href="borrow_book.php">Borrow A Book</a>&nbsp;&nbsp;&nbsp;
    <a href="borrow_history.php">Borrow History</a></p>&nbsp;&nbsp;&nbsp;
    <a href="changepsw.php">Change Password</a></p>
    <br>

    <style>
    table,th,td
    {
      border:1px solid black;
    }
    </style>
    <p>List of Books Currently Being Borrowed:</p>
    <table>
    <tr bgcolor="#A20046">
    	<td><font color="white">Book Title</font></td>
    	<td><font color="white">Book Author</font></td>
    	<td><font color="white">ISBN</font></td>
    	<td><font color="white">Due Date</font></td>
    	<td><font color="white">Renew Book</font></td>
    </tr>
    <?php foreach ($books as $book):
    	$biid = $book['biid'];
    	$title = $book['title'];
    	$afirstname = $book['afirstname'];
    	$alastname = $book['alastname'];
    	$isbn = $book['isbn'];
    	$duedate = $book['duedate'];
	?>
    	<tr bgcolor="#E59F15">
    		<td> <?php echo $title; ?> </td>
    		<td> <?php echo "$afirstname $alastname"; ?> </td>
    		<td> <?php echo $isbn; ?> </td>
    		<td> <?php echo $duedate; ?> </td>
    		<td>
    			<form name="renew" method="post" action="renew_book.php">
    				<input value="<?php echo $biid;?>" type="hidden" id="bookid" name="bookid">
     				<input type="submit"  value="Renew">
   				</form>
    		</td>
    	</tr>
    <?php endforeach; ?>
    </table>
    
    <?php include_once "googletranslator.php"; ?>
</center>
</body>

</html>
