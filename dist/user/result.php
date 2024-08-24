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
$date=date("Y-m-d H:i:s");
$_SESSION["end_time"]=date("Y-m-d H:i:s", strtotime($date."+ $_SESSION[exam_time] minutes"));
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <link rel="icon" href="44.jpg" type="image/x-icon">

    <!-- css link -->
    <link rel="stylesheet"  href="result.css">
    
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
            <li><a href="old_exam_result.php">Lastest result</a></li>
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
        <div><img src="image/gold_cup.png" class="gold" alt=""></div>
        <?php
        $correct=0;
        $wrong=0;

        if(isset($_SESSION["answer"]))
        {
            for ($i=1; $i<=sizeof($_SESSION["answer"]) ; $i++) { 
                $answer="";
                $res=mysqli_query($conn,"select * from questions where category='$_SESSION[exam_category]' && question_no=$i");
                while($row=mysqli_fetch_array($res))
                {
                    $answer=$row["answer"];
                }
                if (isset($_SESSION["answer"][$i])) 
                {
                    if($answer==$_SESSION["answer"][$i])
                    {
                        $correct=$correct+1;
                    }
                    else{
                        $wrong=$wrong+1;
                    }
                }
                else{
                    $wrong=$wrong+1;
                }
            }
        }

        $count=0;

        $res=mysqli_query($conn,"select * from questions where category='$_SESSION[exam_category]'");
        $count=mysqli_num_rows($res);
        $wrong=$count-$correct;
        
        ?>
        <div class="con_mini">
            <div style="color: #2c3e50; font-size: 20px; font-weight: bold;">Total Questions: <?php echo $count; ?></div>
            <div style="margin-top: 10px; color: #2ecc71; font-size: 20px; font-weight: bold;">Correct Answer: <?php echo $correct; ?></div>
            <div style="margin-top: 10px; color: #e74c3c; font-size: 20px; font-weight: bold;">Wrong Answer: <?php echo $wrong; ?></div>
            <div>
            <button type="button" onclick="location.href='select_exam.php'" class="homebutton">Go to Home</button>
            </div>
        </div>
        
        
    </div>
    
    <?php 
    if (isset($_SESSION["exam_start"])) {
        $date=date("Y-m-d");
    mysqli_query($conn,"insert into exam_result(id,username,exam_type,total_question,correct_answer,wrong_answer,exam_time) values(NULL,'$_SESSION[username]','$_SESSION[exam_category]','$count','$correct','$wrong','$date')") or die(mysqli_error($conn));
    }

    if (isset($_SESSION["exam_start"])) {
        unset($_SESSION["exam_start"]);

        ?>
        <script type="text/javascript">
            window.location.href=window.location.href;
        </script>
        <?php

    }

    ?>
    

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
