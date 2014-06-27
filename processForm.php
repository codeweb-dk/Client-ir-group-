<?php

// Clean up the input values
foreach($_POST as $key => $value) {
	if(ini_get('magic_quotes_gpc'))
		$_POST[$key] = stripslashes($_POST[$key]);
	
	$_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
}

// Assign the input values to variables for easy reference
$firmnavn = strip_tags($_POST["InputFirmName"]);
$name = strip_tags($_POST["InputName"]);
$email = strip_tags($_POST["InputEmail"]);
$kommentar = strip_tags($_POST["InputMessage"]);
$adress = strip_tags($_POST["InputAdress"]);
$postnr = strip_tags($_POST["InputPostNr"]);

            $message = '<html><body>';
			$message .= '<img src="http://www.irgroup.codeweb.dk/images/irlogo.png" alt="ir group" />';
			$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			$message .= "<tr style='background: #eee;'><td><strong>Firmanavn:</strong> </td><td>" . $firmnavn . "</td></tr>";
			$message .= "<tr><td><strong>Full Navn:</strong> </td><td>" . $name . "</td></tr>";
			$message .= "<tr><td><strong>Email:</strong> </td><td>" . $email . "</td></tr>";
			$message .= "<tr><td><strong>Adresse:</strong> </td><td>" . $adress . "</td></tr>";
			$message .= "<tr><td><strong>Post nr og by:</strong> </td><td>" . $postnr . "</td></tr>";
			$message .= "<tr><td><strong>Kommentar:</strong> </td><td>" . $kommentar. "</td></tr>";
			$message .= "</table>";
			$message .= "</body></html>";


// Test input values for errors
$errors = array();
if(strlen($name) < 2) {
	if(!$name) {
		$errors[] = "You must enter a name.";
	} else {
		$errors[] = "Name must be at least 2 characters.";
	}
}
if(!$email) {
	$errors[] = "You must enter an email.";
} else if(!validEmail($email)) {
	$errors[] = "You must enter a valid email.";
}
if(strlen($message) < 10) {
	if(!$message) {
		$errors[] = "You must enter a message.";
	} else {
		$errors[] = "Message must be at least 10 characters.";
	}
}

if(!$adress) {
	$errors[] = "You must enter an adress.";
} 
if(!$postnr) {
	$errors[] = "You must enter a postnr.";
} 


if($errors) {
	// Output errors and die with a failure message
	$errortext = "";
	foreach($errors as $error) {
		$errortext .= "<li>".$error."</li>";
	}
	die("<div class='alert alert-danger'><span class='glyphicon glyphicon-alert'></span><strong>The following errors occured:<ul>". $errortext ."</ul></strong></div>");
}
                    require("sources/connection.php");
			        mysqli_set_charset($conn, "utf8");
					$sql = "SELECT * FROM kontakt WHERE name='gkontakt'";
					$result = $conn->query($sql) or die(mysqli_error());
					if($result){
						$row = $result->fetch_object();
//email style
// Send the email
$to = "$row->mainmail";
$subject = "Message from : $name";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .='From: himelhunny@yahoo.com'."\r\n".'Reply-To: himelhunny@yahoo.com'."\r\n".'Cc:'. "$row->bcmail";


mail($to, $subject, $message, $headers);

// Die with a success message
die("<div class='alert alert-success'><strong><span class='glyphicon glyphicon-send'></span>Succes! Din besked er blevet sendt.</strong></div>");
}
// A function that checks to see if
// an email is valid
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }
   }
   return $isValid;
}

?>