<?php
session_start();

if (isset($_GET['un']) and isset($_GET['un']))
{
  $fpusername = $_GET['un'];
  $fputype = $_GET['ut'];
}
else
{
  $fpusername = $_SESSION['username'];
  $fputype = $_SESSION['utype'];
}
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

  <?php if(isset($_SESSION['username']) and isset($_SESSION['utype'])): ?>
    <!-- logout button on the upper right corner of the screen -->
    <div style="position:absolute; top:0; right:0;">
        <input type="button" name="logout" id="logout "value="logout" onclick="window.location.href='logout.php'" style="background-color:maroon">
    </div>
  <?php endif; ?>

  <center>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
    <br>
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
    <br><br>
<form action="changepswp.php" method="post">

  <div>
    <!--cppsw-change password password , cpcpsw-change passowrd confirm password -->
    <label for="cppsw"><b>Password     </b></label>
    <input type="password" placeholder="Enter Password" id="cppsw" name="cppsw"
    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>

    <label for="cpcpsw"><b>Confirm Password</b></label>
    <input type="password" placeholder="Enter Password" id="cpcpsw" name="cpcpsw"
    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
    <span id='message'></span>

    <script>
    $('#psw, #cpsw').on('keyup', function () {
    if ($('#psw').val() == $('#cpsw').val()) {
        $('#message').html('Matching').css('color', 'green');
    } else
        $('#message').html('Not Matching').css('color', 'red');
      });
    </script>
    <br>
    <!-- Passing username and utype using POST method -->
    <input type="hidden" name="fpusername" value="<?php echo $fpusername; ?>"><br>
    <input type="hidden" name="fputype" value="<?php echo $fputype; ?>"><br>

    <!--utype is for usertype(i.e administrator or student) -->
    <input type="radio" name="utype" id="utypes" value="student" checked>
    <label for="utypes">Student</label>
    <input type="radio" name="utype" id="utypea" value="administrator">
    <label for="utypea">Administrator</label>

  </div>

  <div>
    <br><br>

    <input type="submit" name="changepsw" id="changepsw" value="change password"><br><br>
  </div>
  </div>
</form>

<?php include_once "googletranslator.php"; ?>

</center>
</body>
</html>
