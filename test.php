
<?php

function is_connected()
{
    $connected = @fsockopen("www.example.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}


ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $_POST = json_decode(file_get_contents("php://input"), true);
  // retrieve the buttonName, browserName, browserVersion, and browserOS from the $_POST variable
  $buttonName = $_POST['button'];
  $browserName = $_POST['browser']['name'];
  $browserVersion = $_POST['browser']['version'];
  $browserOS = $_POST['browser']['os'];
  $browserid=$_POST['browser']['id'];
  $timestamp=$_POST["timestamp"];
  // do something with the data
  // for example, you can write it to a file or database


// Load the Google Sheets API library
require_once 'vendor/autoload.php';

// Create a new Google client instance
if (is_connected()) {
$client = new Google\Client();
$client->setAuthConfig('communication-hub-390711-d9756bfcabcf.json');
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
$client->addScope(Google_Service_Sheets::SPREADSHEETS);
$client->setAccessType('offline');

// Get authorization URL
$authUrl = $client->createAuthUrl();
$service = new \Google_Service_Sheets($client);

// Set the spreadsheet ID
$spreadsheetId = '11DU2a4gcD-xSdXZo9aJVofsiVb3zOL3_moqmnY00CdI';

// // Check if button is pressed


//     // Get the cell range for the next empty row
    $values = $service->spreadsheets_values->get($spreadsheetId, 'Sheet1!A:A')->getValues();
    
// // Check if button is pressed


//     // Get the cell range for the next empty row
    $nextRow = count($service->spreadsheets_values->get($spreadsheetId, 'Sheet1!A:A')->getValues()) + 1;
    $range = "Sheet1!A{$nextRow}:E{$nextRow}";

    // Set the button data in a cookie
    

    
    $requestBody = new Google_Service_Sheets_ValueRange();
    $requestBody->setValues( ['values' => [$buttonName,$browserName,$browserOS,$browserid,$timestamp]]);
    $params = ['valueInputOption' => 'RAW'];
  
 
      // Update values in Google Sheets
      $service->spreadsheets_values->update($spreadsheetId, $range, $requestBody, $params); 
    } else {
      // Save data to local CSV file
      $csv_file = fopen("data.csv", "a");
      $csv_data = [$buttonName,$browserName,$browserOS,$browserid,$timestamp];
      fputcsv($csv_file, $csv_data);
      fclose($csv_file);
    }
    

//     // rest of the code
}


?>




