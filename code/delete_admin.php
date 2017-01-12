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
	$admins = $pdo->query('SELECT * FROM administrator');
}
catch (PDOException $e)
{
    $error = 'Database error selecting from administrator!';
    include 'error.html.php';
    exit();
}
?>

<html>
<head>
	<meta charset="utf-8">
    <title>DeleteAdmin</title>
</head>

<body>
  <!-- logout button on the upper right corner of the screen -->
  <div style="position:absolute; top:0; right:0;">
      <input type="button" name="logout" id="logout "value="logout" onclick="window.location.href='logout.php'" style="background-color:maroon">
  </div>

  <center>
	<IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <h2>Delete Admins</h2>

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
    <p>List of Admins:</p>
    <table>
    <tr bgcolor="#B22C4F">
    	<td><font color="white">Username</font></td>
    	<td><font color="white">Name</font></td>
    	<td><font color="white">Delete</font></td>
    </tr>



	<?php foreach ($admins as $admin):
    	$username = $admin['username'];
		$sfirstname = $admin['sfirstname'];
		$slastname = $admin['slastname'];
	?>
    	<tr bgcolor="#E59F15">
    		<td> <?php echo $username; ?> </td>
    		<td> <?php echo "$sfirstname $slastname"; ?> </td>
    		<td>
    			<form name="delete" method="post" action="delete.php">
    				<input value="<?php echo $username;?>" type="hidden" id="username" name="username">
     				<input type="submit"  value="Delete">
   				</form>
   				<?php unset($username); ?>
    		</td>
    	</tr>
    <?php endforeach; ?>
    </table>
    <br>
    <p><a href="admin_home.php">Go back to homepage</a></p>

    <?php include_once "googletranslator.php"; ?>

  </center>
</body>
</html>
