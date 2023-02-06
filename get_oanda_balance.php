<?php
$account_id = '001-001-8985943-002';
$access_token = 'accc68e8342a2d2f386cf321c0031200-7984d597bae11ea968ab9bafc2b34373';

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api-fxtrade.oanda.com/v3/accounts/{$account_id}/summary",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer {$access_token}",
        "Content-Type: application/json",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
}

$data = json_decode($response);

$servername = "localhost";
$username = "jpelton";
$password = "imaSSJ722!";
$dbname = "ForexNFTs";

$dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$query = "INSERT INTO Balances (balance, account) VALUES ('{$data->account->balance}', 'oanda')";

// Run your query
$sth = $dbh->prepare($query);
$sth->execute();

// Close connection
$dbh = null;

echo "Finished\n";

?>