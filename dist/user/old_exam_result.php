<?php
session_start();
require '../config.php';
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM student WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("location: ../index.php");
}
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <link rel="icon" href="44.jpg" type="image/x-icon">

    <!-- css link -->
    <link rel="stylesheet"  href="demo.css">
    
    <!-- boxicons link-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!--Google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@900&family=Noto+Sans:wght@900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet"></head>
    
<body>
    
    <!-- Header design-->
    <header id="hdd">
        <a href="select_exam.php">
        <img src="image/aa.png" class="logo" alt=""></a>
        <ul class="navbar" id="sidemenu">
            <li><a href="select_exam.php">Select Quiz</a></li>
            <button type="button" onclick="location.href='../logout.php'" class="btnlogin-popup">Logout</button>
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
            <p>Copyright © FoodC All rights reserved</p>
        </div>
    </footer>
    <div class="container">
        <div class="tad">
            <center><h1>Quizes Result </h1></center>
            <?php
            $count=0;
            $res=mysqli_query($conn,"select * from exam_result where username='$_SESSION[username]' order by id desc");
            $count=mysqli_num_rows($res);

            if ($count==0) {
                ?>
                <center><h2>No Results Found </h2></center>
                
                <?php
            }
            else {
                echo "<table>";
                echo "<tr>";
                echo "<th>"; echo"Username"; echo "</th>";
                echo "<th>"; echo"Quiz_type"; echo "</th>";
                echo "<th>"; echo"Total_Question"; echo "</th>";
                echo "<th>"; echo"Correct_answer"; echo "</th>";
                echo "<th>"; echo"Wrong_answer"; echo "</th>";
                echo "<th>"; echo"Quiz_time"; echo "</th>";
                echo "</tr>";
                
                while ($row=mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>"; echo $row["username"]; echo "</td>";
                echo "<td>"; echo $row["exam_type"]; echo "</td>";
                echo "<td>"; echo $row["total_question"]; echo "</td>";
                echo "<td>"; echo $row["correct_answer"]; echo "</td>";
                echo "<td>"; echo $row["wrong_answer"]; echo "</td>";
                echo "<td>"; echo $row["exam_time"]; echo "</td>";
                echo "</tr>";
                }

                echo "</table>";
            }

            ?>
        </div>
    </div>
    
    

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
