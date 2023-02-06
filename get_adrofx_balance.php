<?php

//Get data from Browse AI
$teamID = "9b93e61d-1842-4407-8990-7e88a31b74e4";
$robotID = "aa894ab2-b635-4b7a-b474-f0dd34da30d7";
$secretKey = "61fe6a77-84c9-43ac-885d-64797529ca78:e8f5c831-daf7-459d-91e4-a432c3e12d6a";


//Get a list of all tasks in browse.ai
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.browse.ai/v2/robots/{$robotID}/tasks?page=1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Authorization: Bearer $secretKey"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$result = json_decode($response)->result;
	$robotTasks = $result->robotTasks;
	$items = $robotTasks->items;
	$last_item = end($items);
	$balance1 = str_replace('USD','',str_replace(' ','',$last_item->capturedTexts->{'220600 Balance'}));
	$balance2 = str_replace('USD','',str_replace(' ','',$last_item->capturedTexts->{'220628 Balance'}));
	$total_balance = $balance1 + $balance2;
}


//Put in the db
$servername = "localhost";
$username = "jpelton";
$password = "imaSSJ722!";
$dbname = "ForexNFTs";

$dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$request = print_r($_POST,true);

$query = "INSERT INTO Balances (balance, account) VALUES ('$total_balance', 'adrofx')";

// Run your query
$sth = $dbh->prepare($query);
$sth->execute();

// Close connection
$dbh = null;

echo "Finished\n";