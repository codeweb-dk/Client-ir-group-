<?php

// If user pressed "Update Content" button
if(isset($_POST['editContent'])){
	// Update the page's content
	require("sources/connection.php");
	$content = $_POST['content'];
	$content = stripcslashes($content);
	$content =trim($content);
	$content = mysqli_real_escape_string($conn, $content);
	
	
	$id = $_POST['id'];
	$sql = "UPDATE pages SET content='$content' WHERE id='$id'";
	$result = $conn->query($sql) or die(mysqli_error());
	if($result){
		header("location: admin.php?message=1");
	}

}

// If user pressed "Edit Link" button
if(isset($_POST['editLinks'])){
	// Update the navigation link
	require("sources/connection.php");
	$name = $_POST['name'];
	$url = $_POST['url'];
	$title = $_POST['title'];
	$id = $_POST['id'];
	$sql = "UPDATE nav SET name='$name', url='$url', title='$title' WHERE id='$id'";
	$result = $conn->query($sql) or die(mysqli_error());
	if($result){
		header("location: admin.php?message=1");
	}

}

//if user edit email for cv

if(isset($_POST['editCVKontakt'])){
	// Update the navigation link
	require("sources/connection.php");
	$mainmail = $_POST['maemail'];
	$bccmail = $_POST['bcemail'];
	$id = $_POST['id'];
	$sql = "UPDATE kontakt SET mainmail='$mainmail', bcmail='$bccmail' WHERE name='cv'";
	$result = $conn->query($sql) or die(mysqli_error());
	if($result){
		header("location: admin.php?message=1");
	}

}

if(isset($_POST['editGKontakt'])){
	// Update the navigation link
	require("sources/connection.php");
	$mainmail = $_POST['maemail'];
	$bccmail = $_POST['bcemail'];
	$id = $_POST['id'];
	$sql = "UPDATE kontakt SET mainmail='$mainmail', bcmail='$bccmail' WHERE name='gkontakt'";
	$result = $conn->query($sql) or die(mysqli_error());
	if($result){
		header("location: admin.php?message=1");
	}

}



?>