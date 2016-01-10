<?php

$con = mysqli_connect("localhost","root","HorizonCode2015","the_debate");

if (mysqli_connect_errno()) 
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$post = $_POST['post'];

if ($post != "")
{
	$date_added = date("Y-m-d");
	$added_by = "test123";
	$user_posted_to = "test123";

	$query = mysqli_query($con, "INSERT INTO posts VALUES ('','$post', '$date_added', '$added_by', '$user_posted_to')");
}
else
{
	echo "You must enter something in the post field before you can send it ...";
}

?>