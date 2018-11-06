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
    <h2>Newsletter Subscribe</h2>
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
    
    $sql = "SHOW TABLES LIKE '$tableName'";
    $result = mysqli_query($DBConnect, $sql);
    // if the
    if (mysqli_num_rows($result) == 0) {
        echo "<p>The <strong>$tableName</strong>" . " table does not exist, creating table.</p>\n";
        $sql = "CREATE TABLE $tableName" . " (subscriberID SMALLINT NOT NULL" . " AUTO_INCREMENT PRIMARY KEY," . " name VARCHAR(80), email VARCHAR(100), " . "subscribeDate DATE, confirmedDate DATE)";
        $result = mysqli_query($DBConnect, $sql);
        // if there are no results then there will be an error creating the table
        if (!$result) {
            echo "<p>Unable to create the" . " <strong>$tableName</strong> table.<br>\n";
            echo "Error: " . mysqli_error($DBConnect) . " </p>\n";

        } 
        // else will be successful
        else {
            echo "<p>Successfully created the" . " <strong>$tableName</strong> table.</p>\n";
           
        }
        
    } 
    // else will also indicate that the table already exists
    else {
        echo "<p>The <strong>$tableName</strong>" . " table already exist.</p>\n";
  
    }
    // and it will also say that is could not select the database
    
} else {
    echo "Could not select the \"$DBName\"" . "database: " . mysqli_error($DBConnect) . " </p>\n";
}
    // when is doesn not connect then then it will disconnect

    echo "<p>Closing Database Connection.</p>\n";
    mysqli_close($DBConnect);
}
?>

</body>

</html>
