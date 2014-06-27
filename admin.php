<?php

// This is from Jeff's login system
// It double checks to see if I'm logged in
require_once 'sources/login/classes/Membership.php';
$membership = New Membership();
$membership->confirm_Member();

?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

    <head>
        <title>IR Group - vikarbureau</title>
        
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	    <meta name="Author" content="IRGROUP" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    
	    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9" />
		<meta name="Description" content="IR Group er et dansk vikar- og rengøringsbureau, erhvervslivet professionel, lynhurtig og effektiv assistance indenfor rengøring, personaleudvælgelse og vikarløsninger." />
		<meta content="IR Group er et dansk vikar- og rengøringsbureau, erhvervslivet professionel, Renovation, personaleudvælgelse og vikarløsninger, rengøring, Opvask, Tjenere, Køkkenassistenter, Kokke." name="keywords"></meta>
		<meta property="og:title" content="Codeweb" />
		<meta property="og:description" content="IR Group er et dansk vikar- og rengøringsbureau, erhvervslivet professionel, lynhurtig og effektiv assistance indenfor rengøring, personaleudvælgelse og vikarløsninger." />
		<meta property="og:url" content="http://www.irgroup.dk/" />
		<meta name="robots" CONTENT="index, follow">
		<link rel="shortcut icon" href="images/fav.png">

<link rel="stylesheet" href="sources/styles.css" type="text/css" />
<script type="text/javascript" src="sources/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	// TinyMCE Configuration Options
	mode : "textareas",
	theme : "advanced",
	theme_advanced_toolbar_location : "top",
	force_p_newlines : false

});
</script>
</head>
<body>
<div id="container">
	<div id="header">
		<img src="images/irlogo.png" height="75px" width="90px" alt="IR Group"/>
		
		
	</div>
	<div id="content">
		<div id="page">
			<?php
			
				// Check to see if we have been sent from update.php
				// If so, alert that an update was successful			
				if(isset($_GET['message'])){
					echo "<p><font color='red'>Update Successful</font></p>";
				}
				
				// Initiate our connection and check if a page or nav wants to be edited
				require("sources/connection.php");
				$page = (isset($_GET['page'])) ? $_GET['page'] : "1";
				$nav = (isset($_GET['nav'])) ? $_GET['nav'] : "none";
				
				// If a nav item was selected to be edited
				if($nav != "none"){
					// Display form with Name, URL and Title of navigation link we want to edit
					mysqli_set_charset($conn, "utf8");
					$sql = "SELECT id, name, url, title FROM nav WHERE id='$nav'";
					$result = $conn->query($sql) or die(mysqli_error());
					if($result){
						$row = $result->fetch_object();
						echo '<form method="post" action="update.php">';
						echo '<input type="hidden" name="id" value="' . $row->id . '" />';
						echo 'Name: <input type="text" name="name" value="' . $row->name . '" /><br>';
						echo 'URL: <input type="text" name="url" value="' . $row->url . '" /><br>';
						echo 'Title: <input type="text" name="title" value="' . $row->title . '" /><br>';
						echo '<input type="submit" name="editLinks" value="Update Content" />';
						echo '</form>';
					}
					
				// Else we want to edit a page
				} else {
					// Display for with our page's content that we want to edit in our TinyMCE editor
					mysqli_set_charset($conn, "utf8");
					$sql = "SELECT id, content FROM pages WHERE id='$page'";
					$result = $conn->query($sql) or die(mysqli_error());
					if($result){
						$row = $result->fetch_object();
						echo '<form method="post" action="update.php">';
						echo '<input type="hidden" name="id" value="' . $row->id . '" />';
						echo '<textarea name="content" cols="120" rows="50">';
						echo $row->content;
						echo '</textarea>';
						echo '<input type="submit" name="editContent" value="Update Content" />';
						echo '</form>';
					}
				}
				
				
			
			?>
			
			

		</div>
		<div id="sidebar">
			<h4>Pages</h4>
			<ul>
			<?php
				// Display all the pages that we can edit
				$sql = "SELECT id, name FROM pages";
				$result = $conn->query($sql) or die(mysqli_error());
				if($result){
					while($row = $result->fetch_object()){
						echo "<li><a href='admin.php?page={$row->id}'>{$row->name}</a></li>";					
					}
				}
			
			?>
			</ul>
			
			<h5>Change CV Info here</h5><br/><br/>
			<?php	
			        mysqli_set_charset($conn, "utf8");
					$sql = "SELECT * FROM kontakt WHERE name='cv'";
					$result = $conn->query($sql) or die(mysqli_error());
					if($result){
						$row = $result->fetch_object();
						echo '<form method="post" action="update.php">';
						echo '<input type="hidden" name="id" value="' . $row->id . '" />';
						echo 'Mainmail:<input type="text" name="maemail" value="' . $row->mainmail . '" /><br/><br/>';
						echo 'Bccmail:<input type="text" name="bcemail" size="35" value="' . $row->bcmail . '" /><br/><br/>';
						echo '<input type="submit" name="editCVKontakt" value="Update CV Kontakt" />';
						echo '</form>';
						}
			?>
			<br/><br/>
			<h5>Change Kontakt Os Info here</h5><br/><br/>
			<?php	
			        mysqli_set_charset($conn, "utf8");
					$sql = "SELECT * FROM kontakt WHERE name='gkontakt'";
					$result = $conn->query($sql) or die(mysqli_error());
					if($result){
						$row = $result->fetch_object();
						echo '<form method="post" action="update.php">';
						echo '<input type="hidden" name="id" value="' . $row->id . '" />';
						echo 'Mainmail:<input type="text" name="maemail" value="' . $row->mainmail . '" /><br/><br/>';
						echo 'Bccmail:<input type="text" name="bcemail" size="35" value="' . $row->bcmail . '" /><br/><br/>';
						echo '<input type="submit" name="editGKontakt" value="Update Kontakt Os" />';
						echo '</form>';
						}
			?>
		</div>
		<div class="clear"></div>
	</div>
	<div id="footer">
		<p>Copyright © 2014 IR Group ApS. All rights reserved.</p>
	</div>
			
</div>
</body>
</html>
