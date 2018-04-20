<?php

require('_db.php');

$query = 'DELETE FROM tests WHERE test_id = :testid';
$stmt = $db->prepare($query);
$stmt->bindParam(':testid',$_POST['testid'], PDO::PARAM_INT);
$stmt->execute();
header('location: testdata.php');

?>