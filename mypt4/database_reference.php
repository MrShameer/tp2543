<?php
session_start();

//your credential
$servername = ".....";
$username = "...";
$password = "...";
$dbname = "....";


$conn = null;
try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}
?>