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
	$books = $pdo->query('SELECT * FROM book WHERE borrowed=0 AND active=1');
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
    <title>BorrowBook</title>
</head>
<center>
<body>
  <!-- logout button on the upper right corner of the screen -->
  <div style="position:absolute; top:0; right:0;">
      <input type="button" name="logout" id="logout "value="logout" onclick="window.location.href='logout.php'" style="background-color:maroon">
  </div>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <h2>Borrow A Book</h2>

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

    <p>Below is a list of books that are currently available. Click the Book ID for more details.</p><br>

    <p>Search for books based on your zipcode: </p>
    <form action="zip.php" method="post">
    	<div>
    		<label for="zipcode"><b>Zipcode:</b></label>
    		<input type="number" placeholder="Enter zipcode" id="zip" name="zip" required><br>
    		<div>
    			<input type="submit" name="search" id="search" value="Search">
    		</div>
    	</div>
    </form>


    <style>
    table,th,td
    {
    border:1px solid black;
    }
    </style>
    <table>
    <tr bgcolor="#A20046">
    	<td><font color="white">Book ID</font></td>
    	<td><font color="white">Title</font></td>
    	<td><font color="white">Author</font></td>
    </tr>
    <?php foreach ($books as $book):
    	$title = $book['title'];
    	$afirstname = $book['afirstname'];
    	$alastname = $book['alastname'];
	?>
    	<tr bgcolor="#E59F15">
    		<td> <a href="book_info.php?id=<?php echo $book['bookid']; ?>"> <?php echo $book['bookid']; ?> </a></td>
    		<td> <?php echo $title; ?> </td>
    		<td> <?php echo "$afirstname $alastname"; ?> </td>
    	</tr>
    <?php endforeach; ?>
    </table>

    <p><a href="student_home.php">Go back to homepage</a></p>
    <?php include_once "googletranslator.php"; ?>
</body>
</center>
</html>
