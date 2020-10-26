<style>
    <?php include 'css/stylemain.css';?>
</style>

<div>
<div class="main-nav">
    <a href="">Personal Information</a><br>
    <a href="">Food</a><br>
    <a href="">Fitness</a><br>

</div>
<div class="main-content">
<?php
    session_start();  
    $ctr = 0;
    $mealsArray = ['breakfast','lunch','snacks','dinner'];
    foreach($mealsArray as $meal){ 
        $ctr ++; 
            ?>
    
        <div class="meal-box<?php echo $ctr?>" id="<?php echo $meal; ?>" name="<?php echo $meal; ?>">
            <header class="form-header">
                <h3 class="form-heading"><?php echo $meal; ?></h3>
            </header>
            <form action="http://localhost/Health-Fitness-Tracker/meals.php" method="POST">
                <div id="item-list" name="item-list" >

                </div>
                <div class="form-input">
                    <input type="text" placeholder="Add food" id="item">
                    <input type="hidden" name="mealList" id="mealList">
                    <input type="button" id="add" value="+" name='add' onclick="Additem()"><br>
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
        mealList =[];
        function Additem(){
            var item = document.getElementById("item").value;
            var meal = document.getElementById('item-list');
            meal.innerHTML += "<p name='meal-item[]'>" + item + "</p>";
            mealList.push(item);
            var ml = mealList.toString();
            var list = document.getElementById('mealList');
            list.value = ml;
            console.log(mealList);
        }
        
    </script>
<?php
    if(isset($_POST['submit'])){
        $_SESSION['MealList'] = $_POST['mealList'];
        echo $_SESSION['MealList'];
    }
     
?>
