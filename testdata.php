<!DOCTYPE html>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

h1	{
	font-family: arial, sans-serif;
	text-align: center; 
}
</style>
<title>Ordered Test Details</title>
</head>
<body>
<h1>Ordered Test Details</h1>
<table>
  <tr>
    
    <th>Patient Name</th>
    <th>Ordered Test</th>
    <th>Ordered By</th>
    <th>Odered On</th>
    <th>Test Notes</th>
    <th>Update/Delete</th>
  </tr>
  <tr>
  	<?php
  		require('_db.php');
  		$query = 'SELECT * FROM tests ORDER BY trn_date DESC';
  		//$result = $db->query($query);
  		$result = $db->query($query);
  		if(!$result)
  		{
  			echo "Error in query";
  		}
  		else{
  		//print_r($result);
  		
  		foreach($result as $row){
  			$test_id = $row[0];
  			$patient_name = $row[2];
  			$test_type = $row[4];
  			$doctor_name = $row[1];
  			$order_date = $row[6];
  			$notes = $row[5];
  	?>
  	<td><?php echo $patient_name; ?></td>
  	<td><?php echo $test_type; ?></td>
  	<td><?php echo $doctor_name; ?></td>
  	<td><?php echo date('Y-m-d H:i:s', strtotime($order_date)); ?></td>
  	<td><?php echo $notes; ?></td>
  
  	<td>
        <form name="deletetestrec" action="deletetestrec.php" method="POST">
            <input type="hidden" name="testid" value="<?php echo $test_id; ?>"/>
            <input type="submit" name="deletetestrec" value="Delete"/>
        </form>
      </td>
  
  </tr>
  
  	<?php }} ?>
</table>

</body>
</html>

