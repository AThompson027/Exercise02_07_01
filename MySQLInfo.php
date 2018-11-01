<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL Info</title>
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
   <h1>MySQL Database Server Information</h1> 
   <?php 
    // This shows the client info of the server
        echo "<p>MySQL Client Version: " . mysqli_get_client_info() . "</p>\n";
        $hostName = "localhost";
        $userName = "adminer";
        $password = "sense-grass-80";
    // This opens a connection to the server
        $DBConnect = mysqli_connect($hostName, $userName, $password);
    // if there is no connection then it will state an error
        if (!$DBConnect) {
            echo "<p>Connection failed.</p>\n";
            // if connected then it will close the connection
        } else {
            echo "<p>MySQL connection: " . mysqli_get_host_info($DBConnect) . "</p>\n";
            echo "<p>Closing Database Connection.</p>\n";
            mysqli_close($DBConnect);
        }
    ?>
</body>
</html>
