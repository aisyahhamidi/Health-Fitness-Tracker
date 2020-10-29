<style>
    <?php include 'css/stylemain.css';?>
    .main-content{
        height:100vh;
    }
.box-content{
    padding:2% 1%;
    text-align: center;
    line-height: 1.5;
}
.title-img{
    height:30%;
}
.form-header{
text-align: center;
background-color:#9ba4b4; 
padding: 0.5%;
border-top-left-radius: 10px;
border-top-right-radius: 10px;
}

.form-heading{
color: white;
}

form{
line-height: 9;
margin: 1% 2%;
padding-top: 2%;
color: #7c7575;
line-height: 2.5;
text-align: center;
}

input[type=button],input[type=submit],input[type=reset]{
text-align: center;
color: white; 
background-color: #404b69;
border: none;
border-radius: 5px;
padding: 2% 6%;
font-size: large;
margin: 10% auto;
}

input[type=button]:hover,input[type=submit]:hover,input[type=reset]:hover{
background-color: #00587a; 
}

.form-content{
    padding:0 0;
}

.form-pt1{
    width: 40%;
    float: left;
    text-align: left;
}
.form-pt2{
    width: 48%;
    float: right;
    padding-left: 2%;
    text-align: left;
}

#login-btn{
    padding: 1% 3%;
}

</style>
<script src="https://kit.fontawesome.com/4cf62cb5b0.js" crossorigin="anonymous"></script>
<?php
    session_start();
    if(isset($_POST['update'])){
        echo "yay";
        echo "yay";
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
        $uname = $_SESSION['username'];
        $sqlupdate = "UPDATE User SET pswd = '$pswd' , email = '$emailid', first_name = '$fname', last_name = '$lname', age = '$age', height='$height', uweight = '$weight', goal = '$goal' WHERE username='$uname'";
        if ($conn->query($sqlupdate) === TRUE) {
?>
        <script>alert('Update successful.');</script>;
        <?php
        } 
        else {
            echo "Could not update: " . $conn->error;
        }
        header('location:home.php');
    }
        ?>