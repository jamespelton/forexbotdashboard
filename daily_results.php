<?php
$servername = "localhost";
$username = "jpelton";
$password = "imaSSJ722!";
$dbname = "ForexNFTs";

$dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


$sql = "SELECT created, account, balance FROM Balances where account='oanda'";

$stmt = $dbh->prepare($sql);
$stmt->execute();

//Loop Through Result Set
$records = array();
while ($row = $stmt->fetch()) {
    $records[] = $row;
}

// Initialize variables
$previous_date = '';
$previous_balance = 0;
$total_gain = 0;
$total_loss = 0;

// Loop through the records
foreach($records as $record) {
    // Get the date and balance value
    $date = $record['created'];
    $balance = $record['balance'];

    // Calculate change in balance
    $change = $balance - $previous_balance;

    // If the date is the same as the previous record, add the change in balance to the total gain/loss
    if($date == $previous_date) {
        if($change >= 0)
            $total_gain += $change;
        else
            $total_loss += $change;
    }
    // Else, calculate the percentage gain/loss
    else {
        if($previous_date != '') {
            $gain_percentage = ($total_gain / $previous_balance) * 100;
            $loss_percentage = ($total_loss / $previous_balance) * 100;

            echo 'On ' . $previous_date . ', you gained ' . $gain_percentage . '% and lost ' . $loss_percentage . '%' . "\n";
        }

        // Reset the total gain/loss
        $total_gain = 0;
        $total_loss = 0;
    }

    // Set the previous date and balance
    $previous_date = $date;
    $previous_balance = $balance;
}

// Calculate the percentage gain/loss of the last record
$gain_percentage = ($total_gain / $previous_balance) * 100;
$loss_percentage = ($total_loss / $previous_balance) * 100;

echo 'On ' . $previous_date . ', you gained ' . $gain_percentage . '% and lost ' . $loss_percentage . '%' . "\n";

?>