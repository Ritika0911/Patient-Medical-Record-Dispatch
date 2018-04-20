<?php
$host = "127.0.0.1";
//$port = 3306;
$username = "root";
$password = "";
$database = "hospitalB";

$db = new PDO("mysql:host=$host;",$username,$password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// other init
date_default_timezone_set("UTC");
session_start();

$db->exec("CREATE DATABASE IF NOT EXISTS $database");
$db->exec("use $database");

function tableExists($dbh, $id)
{
    $results = $dbh->query("SHOW TABLES LIKE '$id'");
    if(!$results) {
        return false;
    }
    if($results->rowCount() > 0) {
        return true;
    }
    return false;
}

$exists = tableExists($db, "doctor");

if (!$exists) {
    //create the tables
    $db->exec("CREATE TABLE doctor (
    doctor_id   INTEGER       PRIMARY KEY AUTO_INCREMENT NOT NULL,
    doctor_name VARCHAR (100) NOT NULL
    );");
    
    
    $items = array(
        array('name' => 'Doctor 1'),
        array('name' => 'Doctor 2'),
        array('name' => 'Doctor 3'),
        array('name' => 'Doctor 4'),
        array('name' => 'Doctor 5'),
    );
    $insert = "INSERT INTO doctor (doctor_name) VALUES (:name)";
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':name', $name);
    foreach ($items as $m) {
      $name = $m['name'];
      $stmt->execute();
    }
}
 
$exists = tableExists($db, "testtype");
if (!$exists) {    
    $db->exec("CREATE TABLE testtype (
    	testtype_id	INTEGER       	PRIMARY KEY AUTO_INCREMENT NOT NULL,
    	test_type 	VARCHAR (2) 	NOT NULL,
    	test_name 	VARCHAR (100)	NOT NULL
    	);");
    
    $items = array(
        array('type' => 'A', 
        	'name' => 'Ammonia Test'),
        array('type' => 'B',
        	'name' => 'Blood Group'),
        array('type' => 'C', 
        	'name' => 'Cancer Antigen 125'),
        array('type' => 'D',
        	'name' => 'Diabetes Test'),
        array('type' => 'E', 
        	'name' => 'Eye Test'),
        array('type' => 'F',
        	'name' => 'Female Cancer Screening'),
        array('type' => 'G', 
        	'name' => 'Glycohaemoglobin'),
        array('type' => 'H',
        	'name' => 'HIV'),
        array('type' => 'L', 
        	'name' => 'Lipid Profile'),
        array('type' => 'P',
        	'name' => 'Pregnancy Test'),
    );
    $insert = "INSERT INTO testtype (test_type, test_name) VALUES (:type, :name)";
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':name', $name);
    foreach ($items as $m) {
    	$type = $m['type'];
      $name = $m['name'];
      $stmt->execute();
    }
    
}


$exists = tableExists($db, "tests");
if (!$exists) {
    $db->exec("CREATE TABLE tests (
    	test_id	INTEGER       	PRIMARY KEY AUTO_INCREMENT NOT NULL,
    	doctor_name 	VARCHAR (100) 	NOT NULL,
    	patient_name 	VARCHAR (100)	NOT NULL,
    	gender	VARCHAR (10)	NOT NULL,
    	test_type	VARCHAR (100)	NOT NULL,
    	notes	VARCHAR (500),
    	trn_date 	DATETIME 		NOT NULL
    	);"); 
}

$exists = tableExists($db, "appointment");
if (!$exists) {
    
    $db->exec("CREATE TABLE appointment (
    appointment_id              INTEGER       PRIMARY KEY AUTO_INCREMENT NOT NULL,
    appointment_start           DATETIME      NOT NULL,
    appointment_end             DATETIME      NOT NULL,
    appointment_patient_name    VARCHAR (100),
    appointment_status          VARCHAR (100) DEFAULT 'free' NOT NULL,
    appointment_patient_session VARCHAR (100),
    doctor_id                   INTEGER       NOT NULL
    );");


}



?>