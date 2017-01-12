<html>
<head>
	<meta charset="utf-8">
    <title>AddBook</title>
</head>

<body>
	<!-- logout button on the upper right corner of the screen -->
  <div style="position:absolute; top:0; right:0;">
      <input type="button" name="logout" id="logout "value="logout" onclick="window.location.href='logout.php'" style="background-color:maroon">
  </div>
	<center>
    <IMG SRC="luc.jpg" ALT="LUC Crest" WIDTH=90 HEIGHT=90>
    <h1>LUC Book Share</h1>
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


    <h2>Add A Book</h2>
    <h3>Thank you for sharing your book with others!</h3>
    <p>Please enter the following information for your book...<p>

    <form action="add_bookp.php" method="post">

  	<div class="addbook">
    	<label for="isbn"><b>ISBN</b></label>
    	<input type="text" placeholder="Enter ISBN" id="isbn" name="isbn" required><br>

    	<label for="title"><b>Title</b></label>
    	<input type="text" placeholder="Enter Title" id="title" name="title" required><br>

    	<label for="afirstname"><b>Author's First Name</b></label>
    	<input type="text" placeholder="Enter Author's First Name" id="afirstname" name="afirstname" required><br>

    	<label for="alastname"><b>Author's Last Name</b></label>
    	<input type="text" placeholder="Enter Author's Last Name" id="alastname" name="alastname" required><br>

		<label for="publicationdate"><b>Publication Date</b></label>
    	<input type="text" pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
			 placeholder="Enter Publication Date" id="publicationdate" name="publicationdate" required><br>

    	<div>
     		<br>
     		<input type="submit" id="addbook" name="addbook" value="Add Book"><br><br>
    	</div>
 	</div>

	</form>

    <p><a href="student_home.php">Go back to homepage</a></p>
		<?php include_once "googletranslator.php"; ?>
		</center>
</body>
</html>
