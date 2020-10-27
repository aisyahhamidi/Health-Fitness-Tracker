<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Healthify-Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Recursive&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesforms.css">
    <script src="https://kit.fontawesome.com/4cf62cb5b0.js" crossorigin="anonymous"></script>
    <script>
        function validate(){
            
            var uname = document.getElementById('uname').value;
            var email = document.getElementById('emailid').value;
            var pswd1 = document.getElementById('pswd1').value;
            var pswd2 = document.getElementById('pswd2').value;
            if(uname==""||uname==null){
                alert("Please enter username");
                
            }
            if(pswd1.length<6){
                alert('Password must be atleast 6 characters long');
                
            }
            if{
                if(pswd1.match(/[A-Z]/) == null || pswd1.match(/[a-z]/) == null || pswd1.match(/\W/) == null || pswd1.match(/[0-9]/) == null ){
                alert('Password must contain atleast 1 uppercase letter, 1 lowercase letter and 1 special character!');
                
                }
                else{
                    if(pswd1!=pswd2){
                    alert('Please enter correct password');
                    
                    }
                }
            }
            else{
               
            } 
        }    
    </script>
</head>
<body>
    <header>
        <div class="main-header"> 
            <div class="title-header">
                <h1 class="title-heading"><i class="fas fa-heartbeat"></i>  name TBD</h1>
            </div>
            <div class="nav-header">
                <nav class="nav-items">
                    <ul>
                        <li><a href="register-here.html" target="_blank">Blog</a></li>
                        <li><a href="homepage.html">About Us</a></li>
                        <li><a href="homepage.html">Get in touch</a></li>
                    </ul>  
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="main-content">
            <div class="form box">
                <header class="form-header">
                    <h3 class="form-heading">Registration</h3>
                </header>
                <div class="form-content">
                    <form action="http://localhost/Health-Fitness-Tracker/loginpage.php" method="POST">
                        <div class="top">
                            <div class="form-pt1">
                                <label for="fname">First Name</label>
                                <input type="text" id="fname" name ="fname" ><br>
                                <label for="lname">Last Name</label>
                                <input type="text" id="lname" name ="lname"><br>
                                <label for="uname">Username</label>
                                <input type="text" id="uname" name ="uname"><br>
                                <label for="emailid">Email Id</label>
                                <input type="email" id="emailid" name ="emailid"><br>
                                <label for="pswd">Enter Password</label>
                                <input type="password" id="pswd1" name ="pswd1" required><br>
                                <label for="pswd">Re-Enter Password</label>
                                <input type="password" id="pswd2" name ="pswd2" required><br>
                            </div>
                            <div class="form-pt2">
                                <label for="gen">Gender</label>
                                <input type="radio" id="female" name ="gen">Female
                                <input type="radio" id="male" name ="gen" >Male
                                <input type="radio" id="other" name ="gen">Other<br>
                                <label for="age">Age</label>
                                <input type="number" id="age" name ="age"><br>
                                <label for="weight">Weight (in kgs) </label>
                                <input type="number" id="weight" name ="weight"><br>
                                <label for="height">Height (in cm) </label>
                                <input type="number" id="number" name ="number"><br>
                                
                            </div>
                        </div>
                        <div class="bottom">
                            <input type="submit" name="submit" id="submit" value="REGISTER" onsubmit="validate()">
                        <input type="reset" name="reset" id="reset" value="RESET">
                        </div>
                        
                    </form> 
                </div>    
            </div>
        </div>
    </main>
</body>
</html>

<?php

if(isset($_POST["submit"])){

    $uname = $_POST['uname'];
    echo $uname;
    $pswd = $_POST['pswd1'];
    $emailid = $_POST['emailid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age='';
    $weight='';
    $height='';
    $goal ='';
    if(!empty($_POST['age'])){
        $age = $_POST['age'];
    }
    if(!empty($_POST['weight'])){
        $weight = $_POST['weight'];
    }
    if(!empty($_POST['height'])){
        $height = $_POST['height'];
    }
    if(!empty($_POST['goal'])){
        $goal = $_POST['goal'];
    }

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
    $sqlverify = "SELECT * from User WHERE username = '$uname' ";
    $result = $conn->query($sqlverify);
    if($result){
        if($result->num_rows >0 ){
            ?><script>alert('Username already exists');</script>
        <?php
        }
        else{
            $sqlins = "INSERT INTO User SET username = '$uname', pswd = '$pswd' , email = '$emailid', first_name = '$fname', last_name = '$lname', age = '$age', height='$height', uweight = '$weight', goal = '$goal'";
            if($conn->query($sqlins) === true){
                echo "yay";
            } else{
                echo "ERROR: Could not able to execute $sqlins. " . $conn->error;
            }
        }
    
    }
}
?>