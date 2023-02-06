<?php
// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets($client);

// Get the spreadsheet ID and range for the data you want to read.
$spreadsheetId = '1kz_8QwluvXZcj5RGJJcQvLlOdKqbgLjzJRrZqJ5b9Y0';
$range = 'e2:f2';

// Make the API call.
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

// Print out the data.
if (count($values) == 0) {
  print "No data found.\n";
} else {
  foreach ($values as $row) {
    // Print columns A and E, which correspond to indices 0 and 4.
    printf("%s, %s\n", $row[0], $row[4]);
  }
}
?>