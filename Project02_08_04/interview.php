<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>interviewcandidates.php</title>
    <script src="modernizr.custom.65897"></script>
</head>

<body>
    <h1>Interview Candidates</h1>
    <?php
    // global variables
    $hostname = "localhost";
    $username = "adminer";
    $password = "sense-grass-80";
    $DBName = "interview";
    $tablename = "participants";
    $intName = "";
    $canName = "";
    $position = "";
    $DOI = "";
    $CA = "";
    $PA = "";
    $CS = "";
    $BK = "";
    $comments = "";
    $formErrorCount = 0;
    
    // this function will connect the file to the database
    function connectToDB($hostname, $username, $password) {
    $DBConnect = mysqli_connect($hostname, $username, $password);
        // if the database does not connect then it will display an error
    if (!$DBConnect) {
        echo "<p>Connection error: " . mysqli_connect_error() . "</p>\n";
    }
    return $DBConnect;
    }
    
    // this function selects the database
    function selectDB($DBConnect, $DBName) {
        $success = mysqli_select_db($DBConnect, $DBName);
        if ($success) {
            echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
        }
        else {
            echo "<p>Could not select the \"$DBName\" database:" . mysqli_error($DBConnect) . ", creating it.<p>\n";
            // creates the database
                $sql = "CREATE DATABASE $DBName";
            if (mysqli_query($DBConnect, $sql)) {
                echo "<p>Successfully created the \"$DBConnect\" database.</p>\n";
                $success = mysqli_select_db($DBConnect, $DBName);
                if ($success) {
                    echo "<p>Count not create the \"$DBName\" database.</p>\n";
                }
            } 
            else {
                echo "<p>Could not create the \"$DBName\" database: " . mysqli_error($DBConnect) . "</p>\n";
            }
        }
        return $success;
    
    }
    
    // this function creates the table for the data
    function createTable($DBConnect, $tablename) {
        $success = false;
        $sql = "SHOW TABLES LIKE '$tablename'";
        $result = mysqli_query($DBConnect, $sql);
        if (mysqli_num_rows($result) === 0) {
            // this will create the table with a count ID and will increment with each row
            echo "The <strong>$tablename</strong> table does not exist, creating table.<br>\n";
            $sql = "CREATE TABLE $tablename(countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, intName VARCHAR(40), position VARCHAR(40), DOI DATE, canName VARCHAR(40), CA VARCHAR(40), PA VARCHAR(40), CS VARCHAR(40), BK VARCHAR(40), comments VARCHAR(40))";
            $result = mysqli_query($DBConnect, $sql);
            // if there is no result (table) then there will be an error
            if ($result === false) {
                $success = false;
                echo "<p>Unable to create the $tablename table.</p>";
                echo "<p>Error code " . mysqli_errno($DBConnect) . ": " ,mysqli_error($DBConnect) . "</p>";
            }
            else {
                $success = true;
                echo "<p>Successfully created the $tablename table.</p>";
            }
        }
        // indicates if there already is a table with that name
        else {
            $success = true;
            echo "The $tablename table already exists<br>\n";
        }
        return $success;
    }
    
    // when you press the submit button, then it will strip out and trim unnecessary characters from input to prevent bugs
    if (isset($_POST['submit'])) {
        $intName = stripslashes($_POST['intName']);
        $intName = trim($intName);
        $position = stripslashes($_POST['position']);
        $position = trim($position);
        $canName = stripslashes($_POST['canName']);
        $canName = trim($canName);
        $CA = stripslashes($_POST['CA']);
        $CA = trim($CA);
        $PA = stripslashes($_POST['PA']);
        $PA = trim($PA);
        $CS = stripslashes($_POST['CS']);
        $CS = trim($CS);
        $BK = stripslashes($_POST['BK']);
        $BK = trim($BK);
        $comments = stripslashes($_POST['comments']);
        $comments = trim($comments);
        
        // if the inputs are empty then there will be an error
        if (empty($intName) || empty($position)|| empty($DOI) || empty($canName)  || empty($CA) || empty($PA) || empty($CS) || empty($BK) || empty($comments)) {
            echo "<p>You must enter <strong>all</strong> of the form information.</p>\n";
            ++$formErrorCount;
        }
        if ($formErrorCount === 0) {
            // this connects to the database
        $DBConnect = connectToDB($hostname , $username, $password);
            // if the database is connected then it will select the database and create the table
            if(selectDB($DBConnect, $DBName)){
                if (createTable($DBConnect, $tablename)) {
                    echo "<p>Connection successful!</p>\n";
                    $sql = "INSERT INTO $tablename VALUES(NULL, '$intName', '$position', '$DOI', '$canName', '$CA', '$PA', '$CS', '$BK', '$comments')";
                    $result = mysqli_query($DBConnect, $sql);
                    if ($result === false) {
                        // if there is no result then it will post an error
                        echo "<p>Unable to execute the query.</p>";
                        echo "<p>Error code " . mysqli_errno($DBConnect) . ":" . 
                        mysqli_error($DBConnect) . "</p>";
                    }
                    else {
                        echo "<h3>Thank you for signing our guest book!</h3>";
                        $intName = "";
                        $position = "";
                        $DOI = "";
                        $canName = "";
                        $CA = "";
                        $PA = "";
                        $CS = "";
                        $BK = "";
                        $comments = "";
                    }
        }
            }
            // disconnects the database
            mysqli_close($DBConnect);
        }
    }
?>
    <!--    form-->

    <form action="interview.php" method="post">
       <p><strong>Interviewer Name: </strong><br>
            <input type="text" name="intName" value="<?php echo $intName; ?>"></p>
        <p><strong>Position: </strong><br>
            <input type="text" name="position" value="<?php echo $position; ?>"></p>
        <p><strong>Date of Interview: </strong><br>
            <input type="date" name="date" value="<?php echo $DOI; ?>"></p>
           <hr>
        <p><strong>Candidate Name: </strong><br>
            <input type="text" name="canName" value="<?php echo $canName; ?>"></p>
        <p><strong>Communication Abilities: </strong><br>
            <textarea name="CA" value="<?php echo $CA; ?>"></textarea></p>
        <p><strong>Professional Appearances: </strong><br>
            <textarea name="PA" value="<?php echo $PA; ?>"></textarea></p>
        <p>
            <strong>Computer Skills: </strong><br>
            <textarea name="CS" value="<?php echo $CS; ?>"></textarea></p>
        <p><strong>Business Knowledge: </strong><br>
            <textarea name="BK" value="<?php echo $BK; ?>"></textarea></p>
        <p><strong>Comments: </strong><br>
            <textarea name="comments" value="<?php echo $comments; ?>"></textarea></p>
        <p><input type="submit" name="submit" value="Submit"></p>
    </form>

</body>

</html>
