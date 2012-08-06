<?php
    
	/**
	 * Example 1
	 * Validate a single Email via SMTP
	 */
	// include SMTP Email Validation Class
	require_once('smtp_validateEmail.class.php');
	require_once('DataSource.php');
	$csv = new File_CSV_DataSource;
	$csv->load("csv/test.csv");
	$csv = $csv->getRawArray();
	for ($i = 1; $i < count($csv); $i++) {
	// the email to validate
		$row = $csv[$i];
		$emails = array();
		$fname = $row[0];
		$mname = $row[1];
		$lname = $row[2];
		$domain = $row[3];
		//mike@evensale.com
		$emailstr=$fname.'@'.$domain;
		array_push($emails,$emailstr);
		//mxu@evensale.com
		$emailstr=$fname[0].$lname.'@'.$domain;
		array_push($emails,$emailstr);
		//mikex@evensale.com
		$emailstr=$fname.'.'.$lname[0].'@'.$domain;
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
		//mikex@evensale.com
		$emailstr=$fname[0].'.'.$lname.'@'.$domain;
		array_push($emails,$emailstr);
		//mike-xu@evensale.com
		$emailstr=$fname.'-'.$lname.'@'.$domain;
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
		$SMTP_Validator->debug = true;
		// do the validation
		$results = $SMTP_Validator->validate($emails, $sender);

		// view results
		echo '<div style="border:1px solid blue;">';
		foreach($results as $email=>$result) {
			// send email? 
		  if ($result) {
				echo 'The email address '. $email.' is <span style="color:green;">valid</span></br>';
			} else {
				echo 'The email address '. $email.' is <span style="color:red;">not valid</span></br>';
		  }
		}
		echo '</div>';
	}
?>
