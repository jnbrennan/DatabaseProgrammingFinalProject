<?php 
// Start the session
session_start();


include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

//if not yet logged in, send to login page
if(!isset($_SESSION['username']) or empty($_SESSION['username']))
{
   header("Location: login.php");
} 

if (isset($_POST['search'])) {
	$zipcode = trim($_POST['zip']);

	try
	{
		$search = $pdo->query("SELECT * from book WHERE username IN (SELECT username FROM student
																	WHERE zipcode=$zipcode)");
	}
	catch (PDOException $e) 
	{
		header('Location: borrow_book.php?error=Error selecting from database.');
	}	
}
else 
{
	header('Location: borrow_book.php?error=Please input zipcode.');
}
?>



<html>
<head>
	<meta charset="utf-8">
    <title>ZipCode</title>
</head>
<center>
<body>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <h2>Books By Zipcode</h2>
    <p>Below is a list of books located in your zipcode. Click the Book ID for more details.</p><br>
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
    
    
    <?php foreach ($search as $book):
    	$title = $book['title'];
    	$afirstname = $book['afirstname']; 
    	$alastname = $book['alastname']; 
    	$isbn = $book['isbn'];
    	$pubdate = $book['publicationdate'];  
	?>
	
	
    	<tr bgcolor="#E59F15">
			<td> <a href="book_info.php?id=<?php echo $book['bookid']; ?>"> <?php echo $book['bookid']; ?> </a></td>
			<td> <?php echo $title; ?> </td>
    		<td> <?php echo "$afirstname $alastname"; ?> </td>
    		<td> <?php echo $isbn; ?> </td>
    		<td> <?php echo $pubdate; ?> </td>	
    	</tr>
    <?php endforeach; ?> 
</table>

<br><br><p><a href="borrow_book.php">Go back to available books</a></p>
<p><a href="student_home.php">Go back to homepage</a></p>
    
</body>
</center>
</html>