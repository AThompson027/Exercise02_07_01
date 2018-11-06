<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="modernizr.custom.65897"></script>
</head>

<body>
    <h2>MySQL Database Server Information</h2>
    <?php
echo "<p>MySQL Client Version: " . mysqli_get_client_info() . "</p>\n";
    // global variables
$hostName = "localhost";
$userName = "adminer";
$password = "sense-grass-80";
$DBName = "newsletter1";
    // connects the server
$DBConnect = mysqli_connect($hostName, $userName, $password);
    //if the server is not connected then there will be an error
if (!$DBConnect) {
    echo "<p>Connection error" . mysqli_connect_error() . "</p>\n";
}
    // else will create a database
else{
$sql = "CREATE DATABASE $DBName";
if (mysqli_query($DBConnect, $sql)) {
    echo "Successfully created the \"$DBName\"" . "database.</p>\n";
} else {
    echo "Could not create the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . " </p>\n";
}
    // disconnect the server
    echo "<p>Closing Database Connection.</p>\n";
    mysqli_close($DBConnect);
}
?>
