<style>
    <?php include 'css/stylemain.css';?>

.main-content{
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

table{
    border-collapse: collapse;
    width: 100%;
}

table td{
    padding: 1%;

    text-align: center;
}

table tr:nth-child(odd){
    background-color: #d6d2c4;
}

table th{
    color: white;
    background-color: #968c83 ;
    padding: 1%;
}

.select{
    margin: 2% ;
}

select{
    font-size:medium;
    border-radius: 0;
    padding: 5% 3%;
    background-color: #99a8b2;
    color: white;
    border-style: none;
}


</style>
<script src="https://kit.fontawesome.com/4cf62cb5b0.js" crossorigin="anonymous"></script>
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
$conn = OpenCon();
$uname = $_SESSION['username'];
$dt = date('Y-m-d');
$sqlverify = "SELECT * from calorielog WHERE username = '$uname' and cdate = '$dt'";
$result = $conn->query($sqlverify);
$burnt=0;
$cons=0;
if($result){
    if($result->num_rows ==0 ){
        $sqlins = "INSERT into calorielog set username ='$uname', cdate = '$dt', calories_burnt='$burnt', calories_cons='$cons'";
        if($conn->query($sqlins) === true){
            echo "Inserted into table successfully.";
        } else{
            echo "ERROR: Could not able to execute $sqlins. " . $conn->error;
        }
    }
}
if(isset($_POST['submit'])){
    $name = $_POST['fitness'];
    $cals = $_POST['cals'];
    $ins = "INSERT into fitnesslog set username='$uname', name_of_exercise='$name', calories_burnt = '$cals', cdate='$dt'";
    $calsupdate = "UPDATE calorielog set calories_burnt = calories_burnt + '$cals' where username='$uname' and cdate='$dt'";
    $result = $conn->query($ins);
    if(!($result)){
        echo $conn->error;
    }
    $result1 = $conn->query($calsupdate);
    if(!($result1)){
        echo $conn->error;
    }
}
?>
<div>
    <div class="main-nav">
    <h3 style="color:white;"><i class="fas fa-seedling"></i>yourHealthPal</h3>
        <a href="home.php">Home Page</a><br>
        <a href="personalinfo.php">Personal Information</a><br>
        <a href="meals.php">Food</a><br>
        <a href="fitness.php">Fitness</a><br>
        <a href="logout.php">Logout</a>
    </div>
    <div class="title-img">               
        <img src="images/cycle.jpg" style="width:100%; height:100%">
    </div>
    <div class="main-content">
    <h3 style="text-align:center;">Fitness</h3>
    <form action="http://localhost/Health-Fitness-Tracker/fitness.php" method="POST">
        <div class="form-content">
            <label for="fitness">Enter Exercise</label>
            <input type="text" name="fitness" id="fitness"><br>
            <label for="cals">Enter Calories burnt</label>
            <input type="text" name="cals" id="cals"><br>
        </div>
        <input type="submit" name="submit" id="submit" value="Add  Exercise" >
    </form>
    <div class='workout'>
    <div class="select" style="width:200px;">
    <form action="http://localhost/Health-Fitness-Tracker/fitness.php" method="POST">
    <select name='opt'>
        <option value="0">Select sort option:</option>
        <option value="1">Show All</option>
        <option value="2">Workout</option>
        <option value="3">For current Date</option>
        <option value="4">Calories Burnt H->L</option>
    </select>
    <input type="submit" value="Go!" name="sort">
    </form>
  
</div>
        <?php
            $conn = OpenCon();
            if(isset($_POST['sort'])){
                $sort = $_POST['opt'];                
                if($sort==1){
                    $work = "SELECT * FROM fitnesslog where username='$uname'";
                }
                elseif ($sort ==2) {
                    $work = "SELECT * FROM fitnesslog where username='$uname' ORDER BY name_of_exercise";
                }
                elseif($sort==3){
                    $work = "SELECT * FROM fitnesslog where username='$uname' and cdate='$dt'";
                }
                else{
                    $work = "SELECT * FROM fitnesslog where username='$uname' ORDER BY calories_burnt desc";
                }
                $res = $conn->query($work);
            if($res){
                if($res->num_rows>0){?>
                <table>
                    <tr>
                        <th><b>Date</b></th>
                        <th><b>Name of Workout</b></th>
                        <th><b>Calories Burnt</b></th>
                    </tr>
                    <?php 
                    while($row=$res->fetch_assoc()){?>
                    <tr>
                        <td> <?php echo $row["cdate"]; ?> </td>
                        <td> <?php echo $row["name_of_exercise"]; ?></td>
                        <td> <?php echo $row["calories_burnt"]; ?> </td>
                    </tr>
                    <?php
                    }
                }
            }
            else{
                $conn->error;
            }
            }
           
            
        ?>
    </div>
    </div>
</div>
