<?php
	// ========== Enter your email address here ========== //
	$to = "YOUR EMAIL";
	
	// Clean up the input values
	foreach($_POST as $key => $value) {
		if(ini_get('magic_quotes_gpc'))
			$_POST[$key] = stripslashes($_POST[$key]);
		
		$_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
	}
	
	// Assign the input values to variables for easy reference
	$name = $_POST["name"];
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];
	
	// Check input values for errors
	$errors = array();
	if(strlen($name) < 2) {
		if(!$name) {
			$errors[] = "Please enter your name!";
		} else {
			$errors[] = "Name requires at least 2 characters!";
		}
	}
	if(!$email) {
		$errors[] = "Please enter your email!";
	} else if(!validEmail($email)) {
		$errors[] = "Please enter a valid email!";
	}
	if(strlen($message) < 10) {
		if(!$message) {
			$errors[] = "Please enter a message!";
		} else {
			$errors[] = "Message requires at least 10 characters!";
		}
	}
	
	// Output error message(s)
	if($errors) {
		$errortext = "";
		foreach($errors as $error) {
			$errortext .= "<li>".$error."</li>";
		}
		die("<ul class='errors arrowed'>". $errortext ."</ul>
			<a href='javascript:history.go(0)' class='btn'><i class='icon-left-1'></i> Back</a>");
	}
	
	// Send the email
	if($subject!=""){
		$subject = "Contact Form: $subject";
	}
	else {
		$subject = "Contact Form: $name";
	}
	$message = "$message";
	$headers = "From: ".$name." <".$email.">" . "\r\n" . "Reply-To: " . $email;
	
	mail($to, $subject, $message, $headers);
	
	// Output success message
	die("<p class='success'>Thank you! – Your message has been successfully sent!</p>");
	
	// Check if email is valid
	function validEmail($email) {
		$isValid = true;
		$atIndex = strrpos($email, "@");
		if (is_bool($atIndex) && !$atIndex)	{
			$isValid = false;
		}
		else {
			$domain = substr($email, $atIndex+1);
			$local = substr($email, 0, $atIndex);
			$localLen = strlen($local);
			$domainLen = strlen($domain);
			if ($localLen < 1 || $localLen > 64) {
				// Local part length exceeded
				$isValid = false;
			}
			else if ($domainLen < 1 || $domainLen > 255) {
				// Domain part length exceeded
				$isValid = false;
			}
			else if ($local[0] == '.' || $local[$localLen-1] == '.') {
				// Local part starts or ends with '.'
				$isValid = false;
			}
			else if (preg_match('/\\.\\./', $local)) {
				// Local part has two consecutive dots
				$isValid = false;
			}
			else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
				// Character not valid in domain part
				$isValid = false;
			}
			else if (preg_match('/\\.\\./', $domain)) {
				// Domain part has two consecutive dots
				$isValid = false;
			}
			else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
			str_replace("\\\\","",$local))) {
				// Character not valid in local part unless local part is quoted
				if (!preg_match('/^"(\\\\"|[^"])+"$/',
				str_replace("\\\\","",$local))) {
					$isValid = false;
				}
			}
			if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
				// Domain not found in DNS
				$isValid = false;
			}
		}
		return $isValid;
	}
?>