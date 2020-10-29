<style>
    <?php include 'css/stylemain.css';?>
    .main-content{
        height:100vh;
    }
    .box1, .box3{
float: left;
width: 40%;
margin: 50px auto;
background: white;
border-radius: 10px;
box-shadow: 5px 5px 15px -5px rgba(0, 0, 0, 0.3);
padding-bottom: 2%;

}

.box2,.box4{
float: right;
width: 40%;
margin: 50px auto;
background: white;
border-radius: 10px;
box-shadow: 5px 5px 15px -5px rgba(0, 0, 0, 0.3);

}
.box-content{
    padding:2% 2%;
    text-align: center;
    line-height: 1.5;
}
.title-img{
    height:30%;
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
    <p class="info">
    <?php
        session_start();
        echo "<h3>Hey ".$_SESSION['name']." </h3>";
        function OpenCon(){
            $dbhost = "localhost";
            $dbuser = "root";
            $dbpass = "1234";
            $db = "health-fitness-tracker";
            $conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
            return $conn;
        }
        $conn = OpenCon();
        $uname = $_SESSION['username'];
        $dt = date('Y-m-d');
        $cal = "SELECT * from calorielog where username='$uname' and cdate='$dt'";
        $res = $conn->query($cal);
        if($res){
            $row = $res->fetch_row();
            if($row){
                $calcons = $row[2];
                $calburn = $row[3];
            }
            else{
                $calcons = 0;
                $calburn = 0;
            }
            
        }

    ?>
    <h4>Calories consumed today: <?php echo "$calcons calories";?></h4>
    <h4>Calories burnt today: <?php echo "$calburn calories";?></h4>

    <?php if($calcons==0){
        echo "<i><b>Head over to the Food tab to log your first meal!</b></i>";
    }
    if($calburn==0){
        echo "<i><b>Time to get a little active ".$_SESSION['name']."</b></i>";
    }
    
    Lorem ipsum dolor sit amet, consectetur adipiscing elit<br/>
    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br>
    Ut enim ad minim veniam <br></p>

    <div>
        <div class="box1" >
                <header class="form-header">
                    <h3 class="form-heading">Food and Nutrition</h3>
                </header>
            
                <div class="box-content" >
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit<br/>
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br>
                    Ut enim ad minim veniam <br>
                    <i class="fas fa-utensils fa-3x" style="color:#7c7575"></i>
                    
                </div>
                
                <form action="http://localhost/Health-Fitness-Tracker/meals.php" method="POST">
                    <input type="submit" name="meals" id="meals" value="LOG MEAL">
                </form>
            </div>
        </div>

        <div class="box2" >
                <header class="form-header">
                    <h3 class="form-heading">Fitness</h3>
                </header>
            
                <div class="box-content" >
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit<br/>
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br>
                    Ut enim ad minim veniam <br>
                    <i class="fas fa-dumbbell fa-3x" style="color:#7c7575"></i>
                </div>
                    
                <form action="http://localhost/Health-Fitness-Tracker/fitness.php" method="POST">
                    <input type="submit" name="meals" id="meals" value="LOG WORKOUT">
                </form>
            </div>
        </div>
    </div>

    
</div>
    