<title>yourHealthPal-MEAL</title>
<style>
    <?php include 'css/stylemain.css';?>

.title-img{
    height:30%;
}
</style>

<script src="https://kit.fontawesome.com/4cf62cb5b0.js" crossorigin="anonymous"></script>

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
        $conn = OpenCon();
        $uname = $_SESSION['username'];
        $dt = date("Y-m-d");
        $flag = 0;
        $sqlverify = "SELECT * from foodlog WHERE username = '$uname' and cdate = '$dt'";
        $result = $conn->query($sqlverify);
        if($result){
            if($result->num_rows ==0 ){
                $sqlins = "INSERT into foodlog set username ='$uname', cdate = '$dt'";
                if($conn->query($sqlins) !== true){
                    echo "ERROR: Could not able to execute $sqlins. " . $conn->error;
                } 
            }
        }
        $sqlverify2 = "SELECT * from calorielog WHERE username = '$uname' and cdate = '$dt'";
        $result = $conn->query($sqlverify2);
        if($result){
            if($result->num_rows ==0 ){
                $cons = 0;
                $burnt = 0;
                $sqlins = "INSERT into calorielog set username ='$uname', cdate = '$dt', calories_cons='$cons', calories_burnt='$burnt' ";
                if($conn->query($sqlins) !== true){
                    echo "ERROR: Could not able to execute $sqlins. " . $conn->error;
                } 
            }
        }
        $ctr = 0;
        $ctr1=0;
        $mealsArray = ['breakfast','lunch','snacks','dinner'];
        if(isset($_POST['submit'])){
            foreach($mealsArray as $meal){
                $ctr1 +=1;
                $calmeal = 0;
                if(!empty($_POST[$meal])){
                    $_SESSION[$meal] = $_POST[$meal];
                    $sessionMeal = $_SESSION[$meal];
                    $arr = explode(',',$sessionMeal);
                    foreach($arr as $item){
                        $calselect = "SELECT DISTINCT calories from fooddb where item='$item'";
                        $result = $conn->query($calselect);
                        if($result){
                            $row = $result->fetch_row();
                            if($row){
                                $calories = $row[0]; 
                                $calmeal += $calories;
                            }
                            else{
                                $avgquery = "SELECT AVG(calories) from fooddb";
                                $res = $conn->query($avgquery);
                                if($res){
                                    $val = $res->fetch_row();
                                    $cal = $val[0];
                                    $calmeal += $cal;
                                }
                            } 
                        }   
                    }
                    $calupdate = "UPDATE calorielog set calories_cons = calories_cons + $calmeal where username = '$uname' and cdate='$dt'";
                    $result2 = $conn->query($calupdate);
                    /*if($result2){
                        $sel = "SELECT calories_cons from calorielog where username = '$uname' and cdate='$dt' ";
                        $result = $conn->query($sel);
                    }
                    else{
                        $conn->error;
                    }*/
                    $mealupdate = "UPDATE foodlog set $meal = '$sessionMeal' where username = '$uname' and cdate='$dt' ";
                    $result = $conn->query($mealupdate);
                }
            }
        }
        $icon = ['mug-hot','pizza-slice','apple-alt','hamburger'];
        foreach($mealsArray as $meal){ 
            $ctr ++;
        ?>
            <div class="meal-box<?php echo $ctr?>">
                <header class="form-header">
                    <h3 class="form-heading"><?php echo $meal; ?></h3>
                </header>
                <form action="http://localhost/Health-Fitness-Tracker/meals.php" method="POST">
                    <div id="item-list<?php echo $ctr;?>" name="item-list<?php echo $ctr;?>" >
                    <?php echo "<i class='fas fa-".$icon[$ctr-1]." fa-3x' style='color:#7c7575'></i>"."<br>";?>
                    <?php
                    $emptymeal = "SELECT * FROM foodlog where ($meal = '' or $meal is null) and username ='$uname'";
                    $result = $conn->query($emptymeal);
                    if($result){
                        if($result->num_rows == 0){
                            $sel = "SELECT $meal FROM foodlog where username ='$uname' and cdate = '$dt' ";
                            $result2 = $conn->query($sel);
                            if($result2){
                                if($result2->num_rows >0){
                                    $row = $result2->fetch_row();
                                    $str = $row[0];
                                    $arr = explode(',',$str);
                                    foreach($arr as $item){
                                        $cal = "SELECT DISTINCT calories FROM fooddb where item='$item'";
                                        $result = $conn -> query($cal);
                                        $calrow = $result->fetch_row();
                                        if($calrow){
                                            $cal = $calrow[0];
                                            echo "<p><b>$item</b> : $cal calories</p>";
                                        }
                                        else{
                                            $avgquery = "SELECT AVG(calories) from fooddb";
                                            $res = $conn->query($avgquery);
                                            if($res){
                                                $val = $res->fetch_row();
                                                $cal = $val[0];
                                                echo "<p><b>$item</b> : $cal calories (average)<br>
                                                <i style='font-size:small;'>item doesn't exist in our database :(</p><br>";
                                                
                                            }
                                        }  
                                    }  
                                }
                            }?>
                        </div>
                        <?php
                        } 
                        else{ ?>
                            </div>
                            <div class="form-input">
                                <input list="items" id="item<?php echo $ctr;?>">
                                <?php
                                $select = "SELECT DISTINCT item FROM fooddb";
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
                        <?php  
                        } 
                    }                    
                    ?>   
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

