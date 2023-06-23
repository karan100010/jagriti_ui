<?php
// Start the session
session_start();

// Record the starting time
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

// Record device information
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (!isset($_SESSION['user_agent'])) {
    $_SESSION['user_agent'] = $user_agent;
}

// Record the button clicks
if (!isset($_SESSION['button_clicks'])) {
    $_SESSION['button_clicks'] = array();
}

if (isset($_GET['button'])) {
    $button = $_GET['button'];
    $_SESSION['button_clicks'][] = $button;

    // Write the session details to a CSV file
    $session_id = session_id();
    $session_length = time() - $_SESSION['start_time'];
    $csv_data = array($session_id, $user_agent, $session_length, $button);
    $fp = fopen('session_data.csv', 'a');
    if (!$fp) {
        echo "Error opening file"; // or use die() function to stop execution
    }
    if (!fputcsv($fp, $csv_data)) {
        echo "Error writing to file"; // or use die() function to stop execution
    }
    fclose($fp);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jagriti </title>
   


  <link rel="stylesheet" href="bootstrap.min.css">
</head>


    <script src="jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            
        }
        main {display: flex;
            justify-content: center; /* centers content horizontally */
            align-items: center; /* centers content vertically */
             /* sets height of the page to 100% of viewport height */
            
        }
        #button_container{ display: flex;
            flex-direction: column; /* positions child elements in a column */
            align-items: center; /* centers content horizontally */
        

        }

        
        .header {
            padding: 20px;
            text-align: center;
            background-color: #0e0d23;
        }
        .header a {
            display: inline-block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
            
        }
        .header a.logo {
            font-size: 35px;
            font-weight: bold;
        }
 
        .header a.active {
            background-color: dodgerblue;
            color: white;
        }
        .header-right {
            float: right;

        }
        button {
            border-radius: 25px;
            border: none;
            background-color: #eca56a;
            color: #0b0b1c;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }
        button:hover {
            background-color: #008CBA;
            color: white;
        }
        button:active{
            background-color: #555;
            transform: translateY(4px);
            color: white;
        }
        @media screen and (max-width: 600px) {
            .header a:not(:first-child) {
                display: none;
            }
            .header a.icon {
                float: right;
                display: block;
            }
        }
        .header a.icon {
            background: black;
            display: none;
            color: white;
            text-align: center;
            padding: 14px 16px;
            position: absolute;
            top: 10px;
            right: 0;
        }
        .header.responsive a.icon {
            position: absolute;
            top: 10px;
            right: 0;
        }
        .header.responsive {
            position: relative;
        }
        .header.responsive a {
            float: none;
            display: block;
            text-align: left;
        }
        .header {
  background-image: url('logo.png');
  background-repeat: no-repeat;
  background-position: center;
  display: flex;
  align-items: center;
  justify-content: center;
  
}
#nev-top{
    background-color: #0e0d23;
}

@media (max-width: 768px) {

  .logo img {
    display: none;
  }
}
#navbarNav{
    color: aliceblue !important;
}

.logo {
  display: block;
  width: 100%;
  height: 100%;
}

.header-right {
  position: relative;
}

.header-right .icon {
  position: absolute;
  top: 0;
  right: 0;
}

@media (max-width: 768px) {
  .header-right {
    display: none;
  }
}
.container-fluid > a{
    color:#4CAF50 !important;

}

    </style>
</head>
<body>

 
      

            <a class="navbar-brand" href="#">
                <img src="logo.png" width="200" height="100" alt="">
              </a>
       
      
<main>
    <div id="button_container">
        
        <!-- Body content goes here -->
        <button><a href="video.php">Video gallery</a></button>
        <button><a href="images">Image gallery</a></button>     
        <button><a href="document">Documents</a></button>
        <button><a href="upload">Uploaded file</a></button>

    </div>
</main>
<script>
function myFunction() {
  var x = document.getElementById("myHeader");
  if (x.className === "header") {
    x.className += " responsive";
  } else {
    x.className = "header";
  }
}
</script>

</body>
</html>

<!-- cokkie -->
<!-- // Load the Google API client library and authenticate with OAuth2 credentials
require_once 'google-api-php-client/vendor/autoload.php';
$client = new Google_Client();
$client->setAuthConfig('path/to/credentials.json');
$client->addScope(Google_Service_Sheets::SPREADSHEETS);
$service = new Google_Service_Sheets($client);

// Define the spreadsheet ID and sheet name where you want to write the session information
$spreadsheetId = 'spreadsheet_id';
$sheetName = 'Sheet1';

// Get the session information from the cookies
$session_length = $_COOKIE['session_length'];
$mac_address = $_COOKIE['mac_address'];
$os_type = $_COOKIE['os_type'];
$device_type = $_COOKIE['device_type'];

// Format the session start time and end time as readable dates
$session_start_time = date('Y-m-d H:i:s', $session_length);
$session_end_time = date('Y-m-d H:i:s');

// Define the values you want to write to the sheet
$values = [
    [$session_start_time, $session_end_time, $mac_address, $os_type, $device_type],
];

// Define the range where you want to write the values
$range = "$sheetName!A1:E1";

// Create a new request to update the sheet with the session information
$requestBody = new Google_Service_Sheets_ValueRange([
    'values' => $values,
]);
$params = [
    'valueInputOption' => 'RAW'
];
$result = $service->spreadsheets_values->append($spreadsheetId, $range, $requestBody, $params);

// Print out the result of the update
printf("%d cells appended.", $result->getUpdates()->getUpdatedCells());
 -->