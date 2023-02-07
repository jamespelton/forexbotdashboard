<?php
$servername = "localhost";
$username = "jpelton";
$password = "imaSSJ722!";
$dbname = "ForexNFTs";

$dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


$sql = "SELECT * FROM Balances";

$stmt = $dbh->prepare($sql);
$stmt->execute();

//Loop Through Result Set
while ($row = $stmt->fetch()) {
    //Calculate Daily Return
    $date = $row['date'];
    $previousValue = $row['value'];
    $dailyReturn = ($previousValue - $row['value']) / $previousValue;
    $dailyReturn = $dailyReturn * 100;
    
    //Display Daily Return on Calendar
    echo "<td>$date: <br>$dailyReturn%</td>";
}