<?php
?>
<style>
    <?php include 'CSS/style1.css';?>
</style>

<?php



    //echo $additional;


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

    $sqlsel = "SELECT item FROM fooddb where meal = 'breakfast'";  
    $result = $conn->query($sqlsel);

    if ($result->num_rows> 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row['item'];
    }
    }

    $sqlsel = "SELECT item FROM fooddb where meal = 'lunch'";  
    $result = $conn->query($sqlsel);

    if ($result->num_rows> 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row['item'];
    }
    }

    $sqlsel = "SELECT item FROM fooddb where meal = 'snack'";  
    $result = $conn->query($sqlsel);

    if ($result->num_rows> 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row['item'];
    }
    }

    $sqlsel = "SELECT item FROM fooddb where meal = 'dinner'";  
    $result = $conn->query($sqlsel);

    if ($result->num_rows> 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row['item'];
    }
    }


    /*$sqlupdate = "UPDATE User SET first_name='hii.hello' WHERE id=2";
    if ($conn->query($sqlupdate) === TRUE) {
        echo "Update successful.";
    } else {
        echo "Could not update: " . $conn->error;
    }*/


 CloseCon($conn);



?>
