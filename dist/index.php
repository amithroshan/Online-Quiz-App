<?php
// Add this line to start the session
require 'config.php';

if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];

    // Check in user table
    $studentResult = mysqli_query($conn, "SELECT * FROM student WHERE username ='$usernameemail' OR email= '$usernameemail'");
    
    if (mysqli_num_rows($studentResult) > 0) {
        $studentRow = mysqli_fetch_assoc($studentResult); // Fetch the user row as an associative array
        
        if ($password == $studentRow["password"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $studentRow["id"]; 
            $_SESSION["username"] = $studentRow["username"];

            if ($studentRow["type"] == "student") {
                header("location: user/select_exam.php");
            } elseif ($studentRow["type"] == "teacher") {
                header("location: admin/exam_category.php");
            }

            exit(); 
        } else {
            echo "<script> alert('Wrong Password'); </script>";
        }
    } else {
        // Check in shop table
        $teacherResult = mysqli_query($conn, "SELECT * FROM teacher WHERE username ='$usernameemail' OR email= '$usernameemail'");
        
        if (mysqli_num_rows($teacherResult) > 0) {
            $teacherRow = mysqli_fetch_assoc($teacherResult); // Fetch the shop row as an associative array
            
            if ($password == $teacherRow["password"]) {
                $_SESSION["login"] = true;
                $_SESSION["id"] = $teacherRow["id"];

                if ($teacherRow["type"] == "teacher") {
                    header("location: admin/exam_category.php");
                }

                exit();
            } else {
                echo "<script> alert('Wrong Password'); </script>";
            }
        } else {
            echo "<script> alert('User Not Registered'); </script>";
        }
    }
}
?>


<!-- Rest of your HTML code remains unchanged -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="icon" href="44.png" type="image/x-icon">

    <!-- css link -->
    <link rel="stylesheet"  href="index.css">
    
    <!-- boxicons link-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!--Google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@900&display=swap" rel="stylesheet">

</head>
<body>
    <!-- Header design-->
    <header id="hdd">
        <a href="index.php">
        <img src="user/image/aa.png" class="logo" alt=""> </a>
        <ul class="navbar" id="sidemenu">
            <button type="button" onclick="location.href='register.php'" class="btnlogin-popup">Register</button>
            <i class='bx bxs-x-square' onclick="closemenu()"></i>
        </ul>
        <i class='bx bx-menu' onclick="openmenu()"></i>
    </header>
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
            <p>Copyright © All rights reserved</p>
        </div>
    </footer>

    <!--container-->
    <!-- <img src="image/aa.png" class="login4to" alt=""> -->
    <div class="container">
        <div class="main-box login">
            <h1>Login</h1>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><i class='bx bxs-envelope'></i></span>
                    <input type="usernameemail" name="usernameemail" id="usernameemail" required>
                    <label>Username or Email</label>
                </div>

                <div class="input-box">
                    <span class="icon"><i class='bx bxs-lock-alt' ></i></i></span>
                    <input type="password" name="password" id="password" required>
                    <label>Password</label>
                </div>

                <!-- <div class="check">
                    <label><input type="checkbox">Remember me</label>
                    <a href="#">Forget Password</a>
                </div> -->

                <button type="submit" class="main-button" name="submit">Login</button>

                <div class="register">
                    <p>If you don't have an account ? <a href="register.php" class="register-link">Register Here</a></p>
                </div>

            </form>
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



