<style>
    <?php include 'css/stylemain.css';?>
</style>

<script src="https://kit.fontawesome.com/4cf62cb5b0.js" crossorigin="anonymous"></script>

<div>
<div class="main-nav">
    <a href="home.php">Home Page</a><br>
    <a href="">Personal Information</a><br>
    <a href="">Food</a><br>
    <a href="">Fitness</a><br>
    <a href="">Logout</a>
</div>
<div class="title-img">               
    <img src="images/meal-img.jpg" style="width:100%; height:100%">
</div>
<div class="main-content">
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
    $dt = date("Y-m-d");
    
    $sqlverify = "SELECT * from foodlog WHERE username = '$uname' and cdate = '$dt'";
    $result = $conn->query($sqlverify);
    if($result){
        if($result->num_rows ==0 ){
            $sqlins = "INSERT into foodlog set username ='$uname', cdate = '$dt'";
            if($conn->query($sqlins) === true){
                echo "Inserted into table successfully.";
            } else{
                echo "ERROR: Could not able to execute $sqlins. " . $conn->error;
            }
        }
    }
    $ctr1=0;
    $mealsArray = ['breakfast','lunch','snacks','dinner'];
    if(isset($_POST['submit'])){
        foreach($mealsArray as $meal){
            $ctr1+=1;
            if(!isset($_SESSION[$meal])){
                $_SESSION[$meal] ='';
            }
            if(!empty($_POST[$meal])){
                $_SESSION[$meal] .=$_POST[$meal].', ';   
            }
            $mealSession = $_SESSION[$meal] ;
            $sqlupdate = "UPDATE foodlog SET $meal='$mealSession' WHERE username='$uname' and cdate = '$dt'";
            if ($conn->query($sqlupdate) === TRUE) {
                $select = "SELECT * FROM foodlog where username='$uname' and cdate='$dt'";
                    $result = $conn -> query($select);
                    if($result){
                        if($result->num_rows>0){
                            $row = $result->fetch_row();
                            $str = $row[$ctr1+1];
                            $arr = explode(',',$str);
                            foreach($arr as $a){
                                $cal = "SELECT calories FROM fooddb where item='$a'";
                                $result = $conn -> query($cal);
                                $calrow = $result->fetch_row();
                                if($calrow){
                                    $cal = $calrow[0];
                                    $_SESSION['TotalCalories']+=$cal;
                                }                                      
                            }
                        }
                    }
            } else {
                echo "Could not update: " . $conn->error;
            }
        }
    }  
?>
<?php
     
    $ctr = 0;
    $icon = ['mug-hot','pizza-slice','apple-alt','hamburger'];
    foreach($mealsArray as $meal){ 
        $ctr ++; 
            ?>
        <div class="meal-box<?php echo $ctr?>" >
            <header class="form-header">
                <h3 class="form-heading"><?php echo $meal; ?></h3>
            </header>
            <form action="http://localhost/Health-Fitness-Tracker/meals.php" method="POST">
                <div id="item-list<?php echo $ctr;?>" name="item-list<?php echo $ctr;?>" >
                <?php echo "<i class='fas fa-".$icon[$ctr-1]." fa-3x' style='color:#7c7575'></i>"."<br>";?>
                <?php
                    $conn = OpenCon();
                    $select = "SELECT * FROM foodlog where username='$uname' and cdate='$dt'";
                    $result = $conn -> query($select);
                    if($result){
                        if($result->num_rows>0){
                            $row = $result->fetch_row();
                            $str = $row[$ctr+1];
                            $arr = explode(',',$str);
                            foreach($arr as $a){
                                $cal = "SELECT calories FROM fooddb where item='$a'";
                                $result = $conn -> query($cal);
                                $calrow = $result->fetch_row();
                                if($calrow){
                                    $cal = $calrow[0];?>
                                <p><?php echo $a." : ".$cal?></p>

                                <?php    
                                }                                      
                            }
                        }
                    }
                ?>   

                </div>
                <div class="form-input">
                    <input list="items" id="item<?php echo $ctr;?>">
                    <?php
                        $select = "SELECT item,meal FROM fooddb";
                        $result = $conn->query($select);
                        if($result->num_rows >0){?>
                        <datalist id="items">
                            <?php while($row = $result->fetch_assoc()) {?>
                                <option value="<?php echo $row['item'];?>"></option>
                            <?php
                            } ?>
                        </datalist>
                        <?php
                        }?>
                    <!--input type="text" placeholder="Add food" id="item<?php/* echo $ctr;*/?>"-->
                    <input type="hidden" id="<?php echo $meal; ?>" name="<?php echo $meal; ?>">
                    <input type="button" id="add" value="+" name='add' onclick="Additem(<?php echo $ctr;?>)"><br>
                    <input type="submit" id="submit" name="submit">
                </div>    
            </form>
        </div>
<?php        
    }
?>
</div>
</div>
<script>
    mealList =[1,2,3,4];
    meals = ['breakfast','lunch','snacks','dinner'];
    for(var i=0;i<4;i++){
        mealList[i]=[];
    }
    function Additem(x){
        var item = document.getElementById("item"+x).value; 
        var meal = document.getElementById('item-list'+x);
        meal.innerHTML += "<p name='meal-item[]'>" + item + "</p>";
        for(var i=1; i<5;i++){
            if(i==x){
                mealList[i-1].push(item);
                var ml = mealList[i-1].toString();
                console.log('item '+ml);
                console.log('Meal '+meals[i-1]);
                var list  = document.getElementById(meals[i-1]);
                list.value= ml;
                console.log(list.value);
            }
        }   
    }   
</script>

