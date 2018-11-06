<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>

<body>
    <h2>Select Test</h2>
    <?php

$hostName = "localhost";
$userName = "adminer";
$password = "sense-grass-80";
$DBName = "newsletter1";
$DBConnect = mysqli_connect($hostName, $userName, $password);
if (!$DBConnect) {
    echo "<p>Connection error" . mysqli_connect_error() . "</p>\n";
}
else{
if (mysqli_select_db($DBConnect, $DBName)) {
    echo "Successfully selected the \"$DBName\"" . "database.</p>\n";
} else {
    echo "Could not select the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . " </p>\n";
}

    echo "<p>Closing Database Connection.</p>\n";
    mysqli_close($DBConnect);
}
?>

</body>

</html>
