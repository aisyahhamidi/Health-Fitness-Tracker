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
                        <li><a href="https://fitfoodiefinds.com" target="_blank">Blog</a></li>
                        <li><a href="homepage.html">About Us</a></li>
                        <li><a href="mailto:hftracker@gmail.com">Get in touch</a></li>
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
                            <input type="submit" name="register" id="register" value="REGISTER" onsubmit="validate()">
                        <input type="reset" name="reset" id="reset" value="RESET">
                        </div>
                        
                    </form> 
                </div>    
            </div>
        </div>
    </main>
</body>
</html>

