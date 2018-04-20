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
<title>Test Order Form</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
	require('_db.php');
	
	
	//session_start();
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['doctorname'])){
		$doctorname = stripslashes($_REQUEST['doctorname']); // removes backslashes
		//$doctorname = mysql_real_escape_string($doctorname); //escapes special characters in a string
		
		$patientname = stripslashes($_REQUEST['patientname']); 
		//$patientname = mysqli_real_escape_string($db,$patientname); 
		
		//$bday = $_REQUEST['bday'];
		
        $gender = $_REQUEST['gender']; 
        
		$testtype = $_REQUEST['testtype'];
		
		$notes = stripslashes($_REQUEST['notes']);
		//$notes = mysqli_real_escape_string($db,$notes);
		
		$trn_date = date("Y-m-d H:i:s");
		
		$query = "INSERT INTO tests (doctor_name, patient_name, gender, test_type, notes, trn_date) VALUES ('$doctorname', '$patientname', '$gender', '$testtype', '$notes', '$trn_date')";
        
        //$query = "INSERT INTO tests (doctor_name, patient_name, test_type, notes, trn_date) VALUES ('$doctorname', '$patientname', '$testtype', '$notes', '$trn_date')";
        $result = $db->query($query);
       if($result){
            echo "<div class='form'><h3>Test order submitted successfully.</h3><br/><a href='dashboard.php'>Dashboard</a></div>";
        }
    }else{
?>
<div class="form">
	<h1>Test Order Form</h1>
	<form name="testorder" action="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<p><span class="error">* required field.</span></p>
	Physician Name: <input type="text" name="doctorname" value="<?php echo ($_SESSION['username']); ?>" required readonly>
	<span class="error">* </span><br><br>
	Patient Name: <input type="text" name="patientname" required />
	<span class="error">* </span> <br><br>

	<!-- Birthday: <input type="date" name="bday" format=date("YYYY-MM-DD")> <br><br> -->
	Gender: <input type="radio" name="gender" value="Female" required />Female
			<input type="radio" name="gender" value="Male" required />Male
	<span class="error">* </span> <br><br>

	Referred Test:
	<select name="testtype" required>
		 <option value="">Select...</option>
		 <option value="Ammonia Test">Ammonia Test</option>
		 <option value="Blood Group">Blood Group</option>
		 <option value="Cancer Antigen 125">Cancer Antigen 125</option>
		 <option value="Diabetes Test">Diabetes Test</option>
		 <option value="Eye Test">Eye Test</option>
		 <option value="Female Cancer Screening">Female Cancer Screening</option>
		 <option value="Glycohaemoglobin">Glycohaemoglobin</option>
		 <option value="HIV">HIV</option>
		 <option value="Lipid Profile">Lipid Profile</option>
		 <option value="Pregnancy Test">Pregnancy Test</option>
	</select>
	<span class="error">* </span><br><br>
	Notes:<textarea name="notes" cols="50" rows="5" placeholder="Enter special notes here...">
	</textarea>

	<input type="submit" name="submit" value="Order Test"/>
	</form>
</div>
<?php } ?>
</body>
</html>
