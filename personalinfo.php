<style>
    <?php include 'css/stylemain.css';?>
    .main-content{
        height:100vh;
        line-height:2;
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
padding: 1% 3%;
font-size: large;
margin: 5% auto;
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
<div>
    <div class="main-nav">
        <a href="home.php">Home Page</a><br>
        <a href="personalinfo.php">Personal Information</a><br>
        <a href="meals.php">Food</a><br>
        <a href="fitness.php">Fitness</a><br>
        <a href="logout.php">Logout</a>
    </div>
    <div class="title-img">               
        <img src="images/main_image1.jpg" style="width:100%; height:100%">
    </div>
    <div class="main-content">
    <h3>Personal Details</h3>
        <?php
            session_start();
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
            $sel = "SELECT * from User where username='$uname'";
            $result = $conn->query($sel);
            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){?>
                <div class="form-content">
                    <div class="form-pt1">
                    <form action="http://localhost/Health-Fitness-Tracker/updateinfo.php" method="POST">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name ="fname" value="<?php echo $row['first_name'];?>"><br>
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name ="lname" value="<?php echo $row['last_name'];?>"><br>
                        <label for="uname">Username</label>
                        <input type="text" id="uname" name ="uname" value="<?php echo $row['username'];?>" readonly><br>
                        <label for="emailid">Email Id</label>
                        <input type="email" id="emailid" name ="emailid" value="<?php echo $row['email'];?>"><br>
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
                        <input type="number" id="age" name ="age" value="<?php if($row['age']==0){echo " ";}?>"><br>
                        <label for="weight">Weight (in kgs) </label>
                        <input type="number" id="weight" name ="weight" value="<?php if($row['uweight']==0){echo " ";}?>"><br>
                        <label for="height">Height (in cm) </label>
                        <input type="number" id="number" name ="number" value="<?php if($row['height']==0){echo " ";}?>"><br>
                    </div>
                </div>
                    <input type="submit" name="update" id="update" value="Update information?" >
                </form>    
                <?php
                }
            }
        ?>
    </div>
</div>
