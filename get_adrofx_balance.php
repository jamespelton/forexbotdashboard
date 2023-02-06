<?php

//Get data from Browse AI
$teamID = "9b93e61d-1842-4407-8990-7e88a31b74e4";
$robotID = "aa894ab2-b635-4b7a-b474-f0dd34da30d7";
$secretKey = "61fe6a77-84c9-43ac-885d-64797529ca78:e8f5c831-daf7-459d-91e4-a432c3e12d6a";


$servername = "localhost";
$username = "jpelton";
$password = "imaSSJ722!";
$dbname = "ForexNFTs";

$dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$request = print_r($_POST,true);

$query = "INSERT INTO log (log_entry, log_time) VALUES ('{$request}', NOW());";

// Run your query
$sth = $dbh->prepare($query);
$sth->execute();

// Close connection
$dbh = null;

echo "Finished\n";