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
	$ad = $pdo->query('SELECT COUNT(username) as count FROM administrator');
	$row = $ad->fetch();
	$admins = $row['count'];

	$us = $pdo->query('SELECT COUNT(username) as count FROM student');
	$row = $us->fetch();
	$users = $row['count'];

	$ou = $pdo->query('SELECT COUNT(DISTINCT username) as count FROM book');
	$row = $ou->fetch();
	$ousers = $row['count'];

	$bu = $pdo->query('SELECT COUNT(DISTINCT username) as count FROM bookorder');
	$row = $bu->fetch();
	$busers = $row['count'];

	$ob = $pdo->query("SELECT COUNT(DISTINCT username) as count FROM book as b WHERE EXISTS (SELECT DISTINCT username FROM bookorder as bo WHERE b.username=bo.username)");
	$row = $ob->fetch();
	$obusers = $row['count'];

	$b = $pdo->query('SELECT COUNT(DISTINCT bookid) as count FROM book');
	$row = $b->fetch();
	$books = $row['count'];

	$ab = $pdo->query('SELECT COUNT(DISTINCT bookid) as count FROM book WHERE active=1');
	$row = $ab->fetch();
	$abooks = $row['count'];

	$bb = $pdo->query('SELECT COUNT(DISTINCT bookid) as count FROM book WHERE borrowed=1');
	$row = $bb->fetch();
	$bbooks = $row['count'];

	$o = $pdo->query('SELECT COUNT(DISTINCT orderid) as count FROM bookorder');
	$row = $o->fetch();
	$orders = $row['count'];

}
catch (PDOException $e)
{
    $error = 'Database error!';
    include 'error.html.php';
    exit();
}
?>


<html>
<head>
	<meta charset="utf-8">
    <title>Stats</title>
</head>

<body>
  <!-- logout button on the upper right corner of the screen -->
  <div style="position:absolute; top:0; right:0;">
      <input type="button" name="logout" id="logout "value="logout" onclick="window.location.href='logout.php'" style="background-color:maroon">
  </div>
  <center>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <h2>Statistics</h2><br>

    <p><strong>Number of Admins: </strong><?php echo $admins; ?> </p>
    <p><strong>Number of Users: </strong><?php echo $users; ?> </p>
    <p><strong>Number of Owning Users: </strong><?php echo $ousers; ?> </p>
    <p><strong>Number of Borrowing Users: </strong><?php echo $busers; ?> </p>
    <p><strong>Number of users who both own and borrow: </strong><?php echo $obusers; ?> </p>
    <p><strong>Total Number of Books: </strong><?php echo $books; ?> </p>
    <p><strong>Number of Active Books: </strong><?php echo $abooks; ?> </p>
    <p><strong>Number of Books Currently Borrowed: </strong><?php echo $bbooks; ?> </p>
    <p><strong>Number of Orders: </strong><?php echo $orders; ?> </p><br>

    <p><a href="admin_home.php">Go back to homepage</a></p>
    <?php include_once "googletranslator.php"; ?>
  </center>
</body>

</html>
