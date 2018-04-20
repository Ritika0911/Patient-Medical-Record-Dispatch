<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$firstname = stripslashes($_REQUEST['firstname']); 
		$firstname = mysqli_real_escape_string($con,$firstname); 
        $lastname = stripslashes($_REQUEST['lastname']); 
		$lastname = mysqli_real_escape_string($con,$lastname); 
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
        $usertype = $_REQUEST['usertype'];
        //$usertype = mysqli_real_escape_string($con,$usertype);

		$trn_date = date("Y-m-d H:i:s");
		
		$query = "SELECT * FROM users WHERE username='$username'";
		
		$result = mysqli_query($con,$query);
		$query_row=mysqli_fetch_array($result);
		if($query_row <> NULL){
			
			echo "<div class='form'><h3>Username already exists.</h3></div>";
		}else{
		
        $query = "INSERT INTO users (username, firstname, lastname, password, email, usertype, trn_date) VALUES ('$username', '$firstname','$lastname', '".md5($password)."', '$email', '$usertype', '$trn_date')";
        	
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }
    
        //$useruniqueid = base_convert(100, 10, 36);
        
        }
    }else{
?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<input type="text" name="firstname" placeholder="FirstName" required />
<input type="text" name="lastname" placeholder="LastName" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<!--<input type="usertype" name="usertype" placeholder="Usertype" required /> -->
<p>
User Type
<select name="usertype">
  <option value="">Select...</option>
  <option value="P">Patient</option>
  <option value="D">Doctor</option>
  <option value="L">Lab Technician</option>
</select>
</p>
<input type="submit" name="submit" value="Register"/>
</form>
<p>Already registered? <a href='login.php'>Login Here</a></p>
</div>
<?php } ?>
</body>
</html>
