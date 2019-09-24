<?php
	include '_inc/dbconn.php'; 
	if (isset($_REQUEST['submit_contact'])){ // Submit contact form request
		// getting variables to store in table
		$fullname = mysql_real_escape_string($_REQUEST['q_fullname']);
		$type = mysql_real_escape_string($_REQUEST['q_type']);
		$email = mysql_real_escape_string($_REQUEST['q_email']);
		$message = mysql_real_escape_string($_REQUEST['q_message']);

		// variables to set on the go
		$status = "TO REVIEW";
		$from = "Homepage";
		$date = date('Y-m-d h:i:s');

		// insert question to table 'questions'
		$insertsql = "INSERT INTO UTasksMAIN.questions values('','$fullname','$email','$type','$message','$status','','$from','$date')";
		mysql_query($insertsql) or die(header('location:http://utasks.me/?contact&error=1'));
		header('location:http://utasks.me/?contact&success=1');
	} elseif (isset($_REQUEST['register_account'])){ // Submit contact form request
		// getting variables to store in table
		$fullname = mysql_real_escape_string($_REQUEST['n_fullname']);
		$username = mysql_real_escape_string($_REQUEST['n_username']);
		$email = mysql_real_escape_string($_REQUEST['n_email']);
		$type = mysql_real_escape_string($_REQUEST['n_type']); // type of account: normal or premium
		$address = mysql_real_escape_string($_REQUEST['n_address']);
		$mobile = mysql_real_escape_string($_REQUEST['n_phone']);
		$gender = mysql_real_escape_string($_REQUEST['n_gender']);
		$dob = mysql_real_escape_string($_REQUEST['n_dob']);

		$pass1 = mysql_real_escape_string($_REQUEST['n_newpass']);
		$pass2 = mysql_real_escape_string($_REQUEST['n_repeatpass']);

		// insert request to table 'usersnew'
		if ($pass1 == $pass2){
			$insertsql = "INSERT INTO UTasksMAIN.usersnew values('','$fullname','$username','$email','$gender','$dob','$type','$address','$mobile','$pass1')";
			mysql_query($insertsql) or die(header('location:http://utasks.me/?register&error=1'));
			header('location:http://utasks.me/?register&success=1');
		} else { // passwords do not match
			header('location:http://utasks.me/?register&error=2');
		}
	}
?>