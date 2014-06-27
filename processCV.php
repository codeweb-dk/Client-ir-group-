<?php
require_once "phpmailer/class.phpmailer.php";
require_once "phpmailer/class.smtp.php";
// Clean up the input values
foreach($_POST as $key => $value) {
	if(ini_get('magic_quotes_gpc'))
		$_POST[$key] = stripslashes($_POST[$key]);
	
	$_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
}

// Assign the input values to variables for easy reference
$fornavn = $_POST["InputFornavn"];
$postnr = $_POST["InputPostnr"];
$efternavn = $_POST["InputEfternavn"];
$telefon = $_POST["InputTelefon"];
$message = $_POST["InputMessage"];
$adress = $_POST["InputAdresse"];
$email = $_POST["InputEmail"];
$ledigprdag = $_POST["InputLedigprden"];
$ledignu = $_POST["ledig"];
$fastjob = $_POST["job"];
$kontorjob = $_POST["kontor"];

if(isset($_POST['ledig']) &&
   $_POST['ledig'] == 'yes')
{
    $mssledig ="Jeg er ledig nu : Checked.";
}

if(isset($_POST['job']) &&
   $_POST['job'] == 'kantine')
{
      $mssjob ="Kantine : Checked.";
}
elseif(isset($_POST['job']) &&
   $_POST['job'] == 'kontor')
   {
	  $mssjob ="Kontor : Checked."; 
   }
   elseif(isset($_POST['job']) &&
   $_POST['job'] == 'andet')
   {
	  $mssjob ="Andet : Checked.";
   }
   
  $services = implode(",", $_POST['kontor']); 
 
/* if( isset( $_POST['kontor'] ) && is_array($_POST['kontor']) ) {
 foreach( $_POST['kontor'] as $value ) {
        //each $value is a selected value from the form
}
}  
/*   
if(isset($_POST['kontor']) && $_POST['kontor'] == 'reception')
        {
            $msskontor = 'Reception : Checked';
        }
if(isset($_POST['kontor']) && $_POST['kontor'] == 'kundeservice')
        {
            $msskontor .= 'Kundeservice : Checked';
        }
if(isset($_POST['kontor']) && $_POST['kontor'] == 'piccoline')
        {
            $msskontor .= 'Piccoline : Checked';
        }
if(isset($_POST['kontor']) && $_POST['kontor'] == 'sekretar')
        {
            $msskontor .= 'Sekretar : Checked';
        }
if(isset($_POST['kontor']) && $_POST['kontor'] == 'korrespondet')
        {
            $msskontor .= 'Korrespondet : Checked';
        }
if(isset($_POST['kontor']) && $_POST['kontor'] == 'bogholderi')
        {
            $msskontor .= 'Bogholderi : Checked';
        }
if(isset($_POST['kontor']) && $_POST['kontor'] == 'rengskab')
        {
            $msskontor .= 'Rengskab : Checked';
        }
if(isset($_POST['kontor']) && $_POST['kontor'] == 'tasteopgaver')
        {
            $msskontor .= 'Tasteopgaver : Checked';
        }


function IsChecked($chkname,$value)
    {
        if(!empty($_POST[$chkname]))
        {
            foreach($_POST[$chkname] as $chkval)
            {
                if($chkval == $value)
                {
                    return true;
                }
            }
        }
        return false;
    }
    */
    

 
// Test input values for errors
$errors = array();
if(strlen($fornavn) < 2) {
	if(!$fornavn) {
		$errors[] = "You must enter a name.";
	} else {
		$errors[] = "Name must be at least 2 characters.";
	}
}
if(strlen($efternavn) < 2) {
	if(!$efternavn) {
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
if(!$telefon) {
	$errors[] = "You must enter your telefon.";
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

// Send the email
$to_name = "Junk mail";
$to = "me@aminiis.dk";
$subject = "Message from : $fornavn";
$cvattach = $_FILES['vedheftcv']['name'];
$cvattach_temporari = $_FILES['vedheftcv']['tmp_name'];
$cvattach_type = $_FILES['vedheftcv']['type'];
$billedeattach = $_FILES['vedheftbillede']['name'];
$billede_temporari = $_FILES['vedheftbillede']['tmp_name'];
$billede_type = $_FILES['vedheftbillede']['type'];
$target = "attachments/";
$message .= "$fornavn \n";
$message .= "Kontakt Information:\n $efternavn\n";
$message .= "$adress\n";
$message .="$postnr\n";
$message .= "$telefon\n";
$message .= "$mssledig \n";
$message .= "Jeg er udelukkende interesseret i fast job indenfor: \n";
$message .= "$mssjob\n";
$message .= "Kontor:\n";
$message .= "$services\n";


$headers = "From: $email";

$mail = new PHPMailer();
$mail->IsMail();
$mail->From = $subject;
$mail->AddAttachment("/");
$mail->FromName = $fornavn;
$mail->AddAddress($to, $to_name);
$mail->Subject = $subject;
//$mail->AddAttachment = $target;
$mail->AddAttachment($cvattach_temporari, $cvattach);
$mail->AddAttachment($billede_temporari, $billedeattach);
$mail->Body = $message;
    //$msskontor = implode(",", $_POST['kontor']);


$mail->Send();

/*if ($mail->Send()):
//se mandou email mostra mensagem de sucesso
echo "e-mail sent success!";
else:
//se nao mandou mostra mensagem de erro
echo "Erro in sending mail " . $mail->ErrorInfo;
endif;*/
//mail($to, $subject, $message, $headers);

// Die with a success message
die("<div class='alert alert-success'><strong><span class='glyphicon glyphicon-send'></span>Succes! Din besked er blevet sendt.</strong></div>");

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