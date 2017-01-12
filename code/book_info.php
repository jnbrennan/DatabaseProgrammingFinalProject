<?php

include $_SERVER['DOCUMENT_ROOT'].'/includes/db.inc.php';

session_start();

$lsGet = $_GET;
if (!isset($lsGet['id']))
{
    $lsGet['id'] = " ";
}
$id = $lsGet['id'];
unset($lsGet['id']);


//if not yet logged in, send to login page
if(!isset($_SESSION['username']) or empty($_SESSION['username']))
{
   header("Location: login.php");
}

try
{
	$books = $pdo->query("SELECT * FROM book WHERE bookid=$id");
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
    <title>BookInfo</title>
</head>

<body>
  <!-- logout button on the upper right corner of the screen -->
  <div style="position:absolute; top:0; right:0;">
      <input type="button" name="logout" id="logout "value="logout" onclick="window.location.href='logout.php'" style="background-color:maroon">
  </div>
	<center>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <h2>Book Info</h2>

    <p style="color:red; font-weight: bold">
      <?php
        $lsGet = $_GET;
        if (!isset($lsGet['error']))
        {
          $lsGet['error'] = " ";
        }
        echo $lsGet['error'];
        unset($lsGet['error']);
      ?>
    </p>

    <style>
    table,th,td
    {
    border:1px solid black;
    }
    </style>
    <table>
    <tr bgcolor="#A20046">
    	<td><font color="white">Book ID</font></td>
    	<td><font color="white">Book Title</font></td>
    	<td><font color="white">Author</font></td>
    	<td><font color="white">ISBN</font></td>
    	<td><font color="white">Publication Date</font></td>
    </tr>


    <?php foreach ($books as $book):
    	$title = $book['title'];
    	$afirstname = $book['afirstname'];
    	$alastname = $book['alastname'];
    	$isbn = $book['isbn'];
    	$pubdate = $book['publicationdate'];
	?>


    	<tr bgcolor="#E59F15">
			<td> <?php echo $id; ?> </td>
			<td> <?php echo $title; ?> </td>
    		<td> <?php echo "$afirstname $alastname"; ?> </td>
    		<td> <?php echo $isbn; ?> </td>
    		<td> <?php echo $pubdate; ?> </td>
    	</tr>
    <?php endforeach; ?>
    </table>
    <br>
    <p>Ready to borrow? Input how many days you would like to borrow the book below.</p>

    <form action="borrow.php" method="post">
    	<div>
    		<label for="numdays"><b>Number of Days:</b></label>
    		<input type="number" placeholder="Enter number of days to borrow" id="numdays" name="numdays" required><br>
    		<!--<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" >-->

    		<div>
    			<input type="submit" name="borrow" id="borrow" value="Borrow">
    		</div>
    	</div>
    </form>

	<br><br><p><a href="borrow_book.php">Go back to available books</a></p>
    <p><a href="student_home.php">Go back to homepage</a></p>
    <?php include_once "googletranslator.php"; ?>
  </center>
</body>

</html>
