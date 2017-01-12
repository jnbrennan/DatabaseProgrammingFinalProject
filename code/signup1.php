 <!DOCTYPE html>
<html>
<head>
    <title>SignUp</title>
</head>
<body>

<!--
sucls - signup class
suusername - signup username
supsw - signup password
-->
<center>
<IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
<h1>LUC Book Share</h1>
<form action="signupp.php" method="post">

  <div>
    <label for="suusername"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" id="suusername" name="suusername" required><br>

    <label for="supsw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" id="supsw" name="supsw" required><br>

    <label for="sfirstname"><b>Firstname: </b></label>
    <input type="text" placeholder="Enter your first name" id="sfirstname" name="sfirstname" required><br>

    <label for="slastname"><b>Lastname: </b></label>
    <input type="text" placeholder="Enter your last name" id="slastname" name="slastname" required><br>

    <label for="phone"><b>Phone: </b></label>
    <input type="text" placeholder="Enter your phone number" id="phone" name="phone" required><br>

    <label for="street"><b>Street: </b></label>
    <input type="text" placeholder="Enter your street address" id="street" name="street" required><br>

    <label for="city"><b>City: </b></label>
    <input type="text" placeholder="Enter your city" id="city" name="city" required><br>

    <label for="state"><b>State: </b></label>
    <input type="text" placeholder="Enter your state eg. IL, CA, NY" id="state" name="state" required><br>

    <label for="zipcode"><b>Zipcode: </b></label>
    <input type="text" placeholder="Enter your zipcode eg 12345, 56789" id="zipcode" name="zipcode" required><br>
    <br>
    <!--utype is for usertype(i.e administrator or student) -->
    <input type="radio" name="suutype" id="suutypes" value="student" checked>
    <label for="utypes">Student</label>
    <input type="radio" name="suutype" id="suutypea" value="administrator">
    <label for="utypea">Administrator</label>

    <br><br>

    <div>
      <input type="submit" name="signup" id="signup" value="signup"><br><br>

    </div>
  </div>

</form>
</center>
</body>
</html>
