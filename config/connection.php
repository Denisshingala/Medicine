<?php
// dsn link for connection 
$dsn = "mysql:host=localhost;dbname=medicine";

// create connection 
$conn = new PDO($dsn, "root", "") or die("Error: " . $conn->errorInfo());

// sset default attribute for fetching the data from database
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$domain_name = "/medicine";
$success = null;
$error = null;