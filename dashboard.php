<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
 
require('db.php');
include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard - Secured Page</title>
<h1>Dashboard</h1>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
    <?php
   if($_SESSION['usertype'] == 'P'){ ?>
   	<!-- Create a page to display previous appointments and test reports; include a unique patient random ID -->
       <p><a href="patient.php">Patient-Schedule an Appointment</a></p>
    <?php } ?>
    
    
    <?php
    if($_SESSION['usertype'] == 'D'){ ?>
    	<!-- Create a page to display previous appointments and test reports by searhing the patient unique ID-->
    	<!-- A test order form	-->
    	<p><a href="testorder.php">Order A Test</a></p>
       <p><a href="doctor.php">Doctor-Review Scheduled Appointments</a></p>
    <?php } ?>
    
    
    <?php
    if($_SESSION['usertype'] == 'L'){ ?>
       <!-- Edit forms to indicate its status -->
       <p><a href="dummyPatient.php">Lab Technician-View Ordered Tests</a></p>
       <p><a href="testdata.php">Lab Technician-View Ordered Tests</a></p>
    <?php } ?>
    
    <?php
    if($_SESSION['usertype'] == 'A'){ ?>
       <!-- Transfer patient page -->
       <p><a href="manager.php">Manager-Manage Doctor Schedules</a></p>
    <?php } ?>
    
    
    
<p><a href="index.php">Home</a></p>

<a href="logout.php">Logout</a>
    
    
</div>
</body>
</html>
