<?php
$servername = "localhost";
$username = "jpelton";
$password = "imaSSJ722!";
$dbname = "ForexNFTs";

$dbh = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$risky_bot_gain = array();
$risky_bot_loss = array();
$safe_bot_gain = array();
$safe_bot_loss = array();
$risky_bot_balance = array();
$safe_bot_balance = array();


// echo "Safe bot\n";
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
    $date = date('Y-m-d', strtotime($date));

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
            $safe_bot_gain[$previous_date] = $total_gain;
            $safe_bot_loss[$previous_date] = $total_loss;
            $safe_bot_balance[$previous_date] = $previous_balance;
            // echo 'On ' . $previous_date . ', you gained ' . $gain_percentage . '% and lost ' . $loss_percentage . '%' . "\n";
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

$safe_bot_gain[$previous_date] = $total_gain;
$safe_bot_loss[$previous_date] = $total_loss;
$safe_bot_balance[$previous_date] = $previous_balance;

// echo 'On ' . $previous_date . ', you gained ' . $gain_percentage . '% and lost ' . $loss_percentage . '%' . "\n";


/* Risky Bot */

// echo "Risky Bot\n";
$sql = "SELECT created, account, balance FROM Balances where account='adrofx'";

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
    $date = date('Y-m-d', strtotime($date));

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

            $risky_bot_gain[$previous_date] = $total_gain;
            $risky_bot_loss[$previous_date] = $total_loss;
            $risky_bot_balance[$previous_date] = $previous_balance;

            // echo 'On ' . $previous_date . ', you gained ' . $gain_percentage . '% and lost ' . $loss_percentage . '%' . "\n";
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

$risky_bot_gain[$previous_date] = $total_gain;
$risky_bot_loss[$previous_date] = $total_loss;
$risky_bot_balance[$previous_date] = $previous_balance;

// echo 'On ' . $previous_date . ', you gained ' . $gain_percentage . '% and lost ' . $loss_percentage . '%' . "\n";

// print_r($risky_bot_gain);
// print_r($safe_bot_gain);
// print_r($safe_bot_balance);
// print_r($risky_bot_balance);


//We have everything in arrays now, loop through all days that we have records for

foreach ($safe_bot_balance as $date => $balance) {
    echo "$date: \n"
    echo "Safe Balance: $balance\n";
    echo "Risky Balance: " . $risky_bot_balance[$date] . "\n";
    echo "\n"; 
}



?>