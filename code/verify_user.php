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
	$students = $pdo->query("SELECT *
						 FROM student
						 WHERE verified=0");
}
catch (PDOException $e)
{
	header('Location:verify_users.php?error=Database error selecting from student.');
    exit();
}
?>


<html>
<head>
	<meta charset="utf-8">
    <title>VerifyUsers</title>
</head>

<body>
  <!-- logout button on the upper right corner of the screen -->
  <div style="position:absolute; top:0; right:0;">
      <input type="button" name="logout" id="logout "value="logout" onclick="window.location.href='logout.php'" style="background-color:maroon">
  </div>
  <center>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <h2>Verify Users</h2>
    <p>Below is a list of students not yet verified.</p>

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
    	<td><font color="white">Username</font></td>
    	<td><font color="white">Name</font></td>
    	<td><font color="white">Verify</font></td>
    </tr>

    <?php foreach ($students as $student):
    	$username = $student['username'];
    	$sfirstname = $student['sfirstname'];
    	$slastname = $student['slastname'];
	?>

    	<tr bgcolor="#E59F15">
			<td> <?php echo $username; ?> </td>
    		<td> <?php echo "$sfirstname $slastname"; ?> </td>
    		<td>
    			<form name="verify" method="post" action="verify.php">
    				<input value="<?php echo $username;?>" type="hidden" id="username" name="username">
     				<input type="submit" name="verify" value="Verify">
   				</form>
    		</td>
    	</tr>
    <?php endforeach; ?>
</table>

<br><br><p><a href="admin_home.php">Go back to homepage</a></p>

<?php include_once "googletranslator.php"; ?>
</center>
</body>

</html>
