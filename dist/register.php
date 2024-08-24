<?php
require 'config.php';

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $role = $_POST["role"]; // Add this line to get the selected role

    $duplicate = mysqli_query($conn, "SELECT * FROM student WHERE username ='$username' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> alert('Username or Email Already Taken'); </script>";
    } else {
        if ($password == $confirmpassword) {
            if ($role == "option1") {
                $query = "INSERT INTO student (username, email, password) VALUES ('$username', '$email', '$password')";
            } elseif ($role == "option2") {
                $query = "INSERT INTO teacher (username, email, password) VALUES ('$username', '$email', '$password')";
            }
            mysqli_query($conn, $query);
            echo "<script> alert('Registration Successful'); </script>"; 
        } else {
            echo "<script> alert('Password Does Not Match'); </script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="icon" href="44.png" type="image/x-icon">

    <!-- css link -->
    <link rel="stylesheet" href="register.css">
    
    <!-- boxicons link-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <script src="https://kit.fontawesome.com/17f3c4ba2c.js" crossorigin="anonymous"></script>


    <!--Google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@900&family=Noto+Sans:wght@900&display=swap" rel="stylesheet">

</head>
<body>
    <!-- Header design-->
    <nav>
        <header id="hdd">
            <a href="index.php">
            <img src="user/image/aa.png" class="logo" alt=""></a>
            <ul class="navbar" id="sidemenu">
                <button type="button" onclick="location.href='index.php'" class="btnlogin-popup"> Login</button>
                <i class='bx bxs-x-square' onclick="closemenu()"></i>
            </ul>
            <i class='bx bx-menu' onclick="openmenu()"></i>
        </header>
    </nav>

    <footer>
        <div class="footer-content">
            <ul class="socials">
                <li><a href="#"><i class='bx bxl-facebook-circle'></i></i></a></li>
                <li><a href="#"><i class='bx bxl-instagram-alt' ></i></i></a></li>
                <li><a href="#"><i class='bx bxl-linkedin-square' ></i></i></a></li>
                <li><a href="#"><i class='bx bxl-whatsapp-square' ></i></i></a></li>
                <li><a href="#"><i class='bx bxs-envelope'></i></a></li>
            </ul>
        </div>
        <div class="footer-bootom">
            <p>Copyright © FoodC All rights reserved</p>
        </div>
    </footer>
    
    <div class="container">
        <div class="main-box register">
            <h1>User Registration</h1>
            <form action="" method="post">
                
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-user'></i></span>
                    <input type="text" name="username" id="username" required>
                    <label>Username</label>
                </div>

                <div class="input-box">
                    <span class="icon"><i class='bx bxs-envelope'></i></span>
                    <input type="email" name="email" id="email" required>
                    <label>Email</label>
                </div>
 
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                    <input type="password" name="password" id="password" required>
                    <label>Password</label>
                </div>

                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt' ></i></span>
                    <input type="password" name="confirmpassword" id="confirmpassword" required>
                    <label>Confirm Password</label>
                </div>

                <div class="dropdown">
                      
                    <select id="dropdown" name="role" onChange="handleDropdownChange">
                        <option value="option1">As a Student</option>
                        <option value="option2">As a Teacher</option>
                    </select>
                </div>

                <!-- <div class="check">
                    <label><input type="checkbox">I accept all terms & conditions</label>
                </div> -->

                <button type="submit" name="submit" class="main-button">Register</button>

                <div class="register">
                    <p>Already have an account ? <a href="index.php" class="login-link">Login</a></p>
                </div>

            </form>
        </div>
    </div>

    

    <!-- Custom js link -->
    <script type="text/javascript" src="home.js"></script>
    <!-- Custom js link -->
    <script>
     
     var sidemenu = document.getElementById("sidemenu");

     function openmenu(){
        sidemenu.style.right = "0";

     }
     function closemenu(){
        sidemenu.style.right ="-300px";
     }
     

    </script>
    
</body>
</html>
