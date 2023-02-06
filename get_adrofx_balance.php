<?php
$account1 = $_GET['account1'];
$account2 = $_GET['account2'];
$balance = $account1+$account2;

$servername = "localhost";
$username = "root";
$password = "imaSSJ722!";
$dbname = "ForexNFTs";

$dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$query = "INSERT INTO log (log_entry, log_time) VALUES (print_r($_REQUEST,true), NOW());";

// Run your query
$sth = $dbh->prepare($query);
$sth->execute();

// Close connection
$dbh = null;

echo "Finished\n";