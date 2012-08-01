<?php
    
	/**
	 * Example 1
	 * Validate a single Email via SMTP
	 */
	$fname=$_POST["fname"];
	$mname=$_POST["mname"];
	$lname=$_POST["lname"];
	$domain=$_POST["domain"];
	$emailstr="";
	// include SMTP Email Validation Class
	require_once('smtp_validateEmail.class.php');

	// the email to validate
	$emails = array();
	//mike@evensale.com
	$emailstr=$fname.'@'.$domain;
	array_push($emails,$emailstr);
	//mikexu@evensale.com
	$emailstr=$fname.$lname.'@'.$domain;
	array_push($emails,$emailstr);
	//mike_xu@evensale.com
	$emailstr=$fname.'_'.$lname.'@'.$domain;
	array_push($emails,$emailstr);
	//mike.xu@evensale.com
	$emailstr=$fname.'.'.$lname.'@'.$domain;
	array_push($emails,$emailstr);
	//mike-xu@evensale.com
	$emailstr=$fname.'-'.$lname.'@'.$domain;
   array_push($emails,$emailstr);
	//mxu@evensale.com
	$emailstr=$fname[0].$lname.'@'.$domain;
   array_push($emails,$emailstr);
	//mikex@evensale.com
   $emailstr=$fname.'.'.$lname[0].'@'.$domain;
   array_push($emails,$emailstr);
	//xumike@evensale.com
	$emailstr=$lname.$fname.'@'.$domain;
   array_push($emails,$emailstr);
	//mike.chong.xu@evensale.com
	if($mname!="") {
		$emailstr=$fname.'.'.$mname.'.'.$lname.'@'.$domain;
		array_push($emails,$emailstr);
	}
	//mcxu@evensale.com
	if($mname!="") {
		$emailstr=$fname[0].$mname[0].$lname.'@'.$domain;
		array_push($emails,$emailstr);
	}
	// an optional sender
	$sender = 'test@veridian.com';
	// instantiate the class
	$SMTP_Validator = new SMTP_validateEmail();
	// turn on debugging if you want to view the SMTP transaction
	$SMTP_Validator->debug = false;
	// do the validation
	$results = $SMTP_Validator->validate($emails, $sender);

	// view results
	foreach($results as $email=>$result) {
		// send email? 
	  if ($result) {
	  		echo 'The email address '. $email.' is <span style="color:green;">valid</span></br>';
		} else {
			echo 'The email address '. $email.' is <span style="color:red;">not valid</span></br>';
	  }
	}
?>
