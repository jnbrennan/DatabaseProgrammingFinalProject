<?php
// Start the session
session_start();

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
						 WHERE username='{$_SESSION['username']}'");

	$returns = $pdo->query("SELECT *
						 FROM book
						 WHERE username='{$_SESSION['username']}'
						 AND borrowed=1");
}
catch (PDOException $e)
{
    $error = 'Database error selecting from database!';
    include 'error.html.php';
    exit();
}

?>

<html>
<head>
	<meta charset="utf-8">
    <title>ManageBooks</title>
</head>

<body>
  <!-- logout button on the upper right corner of the screen -->
  <div style="position:absolute; top:0; right:0;">
      <input type="button" name="logout" id="logout "value="logout" onclick="window.location.href='logout.php'" style="background-color:maroon">
  </div>
  <center>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <h2>Manage Books</h2>

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

    <p>Here you can activate or deactivate books you have posted.<br>
    Note: you cannot deactivate books currently being borrowed.</p>

    <style>
    table,th,td
    {
    border:1px solid black;
    }
    </style>
    <p><strong>List of Owned Books:</strong></p>
    <table>
    <tr bgcolor="#A20046">
    	<td><font color="white">Book ID</font></td>
    	<td><font color="white">Book Title</font></td>
    	<td><font color="white">Book Author</font></td>
    	<td><font color="white">ISBN</font></td>
    	<td><font color="white">Status</font></td>
    </tr>
    <?php foreach ($books as $book):
    	$bookid = $book['bookid'];
    	$title = $book['title'];
    	$afirstname = $book['afirstname'];
    	$alastname = $book['alastname'];
    	$isbn = $book['isbn'];
    	$active = $book['active'];
    	$borrowed = $book['borrowed'];
	?>
    	<tr bgcolor="#E59F15">
    		<td> <?php echo $bookid; ?> </td>
    		<td> <?php echo $title; ?> </td>
    		<td> <?php echo "$afirstname $alastname"; ?> </td>
    		<td> <?php echo $isbn; ?> </td>
    		<td>
    			<?php if ($active==1)
    			{
    				$activev = "Deactivate";
    			}
    			else
    			{
    				$activev = "Activate";
    			} ?>
    			<input type="button" value="<?php echo $activev; ?>" onclick="window.location.href='status.php?status=<?php echo $activev; ?>&biid=<?php echo $bookid; ?>&borrowed=<?php echo $borrowed; ?>'">
    		</td>
    	</tr>
    <?php endforeach; ?>
    </table><br><br>

    <p>Once you have received your book back, mark it as returned</p>
    <p><strong>List of books currently borrowed:</strong></p>
    <table>
    <tr bgcolor="#A20046">
    	<td><font color="white">Book ID</font></td>
    	<td><font color="white">Book Title</font></td>
    	<td><font color="white">Book Author</font></td>
    	<td><font color="white">ISBN</font></td>
    	<td><font color="white">Return</font></td>
    </tr>
    <?php foreach ($returns as $return):
    	$bookid = $return['bookid'];
    	$title = $return['title'];
    	$afirstname = $return['afirstname'];
    	$alastname = $return['alastname'];
    	$isbn = $return['isbn'];
	?>
    	<tr bgcolor="#E59F15">
    		<td> <?php echo $bookid; ?> </td>
    		<td> <?php echo $title; ?> </td>
    		<td> <?php echo "$afirstname $alastname"; ?> </td>
    		<td> <?php echo $isbn; ?> </td>
    		<td>
    			<input type="button" value="Return" onclick="window.location.href='return.php?bookid=<?php echo $bookid; ?>'">
    		</td>
    	</tr>
    <?php endforeach; ?>
    </table>
    <p><a href="student_home.php">Go back to homepage</a></p>
    <?php include_once "googletranslator.php"; ?>
  </center>
</body>

</html>
