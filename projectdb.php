<?php


function OpenCon(){
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "1234";
    $db = "health-fitness-tracker";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
    
    return $conn;
}
    
function CloseCon($conn){
    $conn -> close();
}
 
$conn = OpenCon();
if($conn === false){
    die("ERROR: Could not connect. " . $conn->connect_error);
}
else
echo "Connected Successfully <br/>";

$sqlcreate = "CREATE TABLE IF NOT EXISTS User(
    username VARCHAR(20) PRIMARY KEY NOT NULL,
    pswd VARCHAR(20) NOT NULL,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email VARCHAR(70) NOT NULL UNIQUE,
    age INT,
    height INT,
    uweight DOUBLE(5,2),
    goal VARCHAR(30)
)";


if($conn->query($sqlcreate) === true){
    echo "Table created successfully. <br/>";
} else{
    echo "ERROR: Could not able to execute $sqlcreate. " . $conn->error;
}

$sqlcreate2 = "CREATE TABLE IF NOT EXISTS foodlog(
    cdate DATE,
    username VARCHAR(20),
    breakfast VARCHAR(200),
    lunch VARCHAR(200),
    snacks VARCHAR(200),
    dinner VARCHAR(200),
    FOREIGN KEY (username) REFERENCES User(username)
)";

$sqlcreate3 = "CREATE TABLE IF NOT EXISTS calorielog(
    cdate DATE,
    username VARCHAR(20),
    calories_cons INT,
    calories_burnt INT
)";

if($conn->query($sqlcreate2) === true){
    echo "Table created successfully. <br/>";
} else{
    echo "ERROR: Could not able to execute $sqlcreate. " . $conn->error;
}

if($conn->query($sqlcreate3) === true){
    echo "Table created successfully. <br/>";
} else{
    echo "ERROR: Could not able to execute $sqlcreate. " . $conn->error;
}


 ?>