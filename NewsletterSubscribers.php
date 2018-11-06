<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Newsletter Subscribe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="modernizr.custom.65897"></script>
</head>

<body>
    <h2>Newsletter Subscribers</h2>
    <?php
// global variables
$hostName = "localhost";
$userName = "adminer";
$password = "sense-grass-80";
$DBName = "newsletter1";
$tableName="subscribers";
$DBConnect = mysqli_connect($hostName, $userName, $password);
    
    //if the server is not connected then there will be an error
if (!$DBConnect) {
    echo "<p>Connection error" . mysqli_connect_error() . "</p>\n";
}
    // if it's connected then if the server is selected then then it will be successful
else{
if (mysqli_select_db($DBConnect, $DBName)) {
    echo "Successfully selected the \"$DBName\"" . "database.</p>\n";
    $sql = "SELECT * FROM $tableName";
    $result = mysqli_query($DBConnect, $sql);
    echo "<p>Number of rows in " . "<strong>$tableName</strong>: " . mysqli_num_rows($result) . "</p>\n";
    echo "<table width='100%' border='1'>\n";
    echo "<tr>";
    echo "<th>Subscriber ID</th>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>Subscriber Date</th>";
    echo "<th>Subscriber Confirm</th>";
    echo "</tr>";
    //this fetches the row with the $result value in it. 
    while ($row = mysqli_fetch_row($result)) {
        // this will display the rows(data) of the table on the page
        echo"<tr>";
        echo "<td>{$row[0]}</td>";
        echo "<td>{$row[1]}</td>";
        echo "<td>{$row[2]}</td>";
        echo "<td>{$row[3]}</td>";
        echo "<td>{$row[4]}</td>";
        echo "</tr>\n";
    }
    echo "</table>\n";
    // This will fetch rows from a result-set then free the memory associated with the result
    mysqli_free_result($result);
}
    else {
    echo "Could not select the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . " </p>\n";
}
    // when is does not connect then then it will disconnect

    echo "<p>Closing Database Connection.</p>\n";
    mysqli_close($DBConnect);
}
?>

</body>

</html>
