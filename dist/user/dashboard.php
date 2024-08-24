<?php
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
    <link rel="stylesheet"  href="dashboard.css">
    
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
        <li style="color: #432818; font-size: 20px;">Welcome <?php echo $row["username"]; ?></li>
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
        <br>
        <div class="row">
            <br>
                <div class="c1">
                    <div id="current_que" style="float:left; color: #252422;">0</div>
                    <div style="float:left; color: #252422;">/</div>
                    <div id="total_que" style="float:left; color: #252422;">0</div>
                </div>
                <div id="countdowntimer" style="float:right; margin-top:-25px; color: #252422;">
                </div>
                <div class="row">
                    <div class="row">
                        <div class="c2" id="load_questions"></div>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="c3" style="min-height:50px;">
                        <div class="c3">
                            <input type="button" class="" value="previous" onclick="load_previous();">&nbsp;
                            <input type="button" class="" value="next" onclick="load_next();">
                        </div>
                    </div>
                </div>
        </div>
    </div>
    
    <script type="text/javascript">

        function load_total_que()
        {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    document.getElementById("total_que").innerHTML=xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","forajax/load_total_que.php",true);
            xmlhttp.send(null);
        }

        var questionno="1";
        load_questions(questionno);

        function load_questions(questionno)
        {
            document.getElementById("current_que").innerHTML=questionno;
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    if(xmlhttp.responseText=="over")
                    {
                        window.location="result.php";
                    }
                    else{
                        document.getElementById("load_questions").innerHTML=xmlhttp.responseText;
                        load_total_que();
                    }
                }
            };
            xmlhttp.open("GET","forajax/load_questions.php?questionno="+ questionno,true);
            xmlhttp.send(null);
        }
        
        function radioclick(radiovalue,questionno){
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    
                }
            };
            xmlhttp.open("GET", "forajax/save_answer_in_session.php?questionno=" + questionno + "&value1=" +radiovalue, true);
            xmlhttp.send(null);
        }

        function load_previous()
        {
            if (questionno=="1")
            {
                load_questions(questionno);
            }
            else{
                questionno=eval(questionno)-1;
                load_questions(questionno);
            }
        }

        function load_next() {
            var totalQuestions = parseInt(document.getElementById("total_que").innerHTML);
            
            if (questionno < totalQuestions) {
                questionno = eval(questionno) + 1;
                load_questions(questionno);
            } else {
                window.location = "result.php";
            }
}





    </script>

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
    <script type="text/javascript">
        setInterval(function() {
            timer();
        }, 1000);
        
        function timer() {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    
                    if (xmlhttp.responseText=="00:00:01") {
                        window.location="result.php";
                    }
                    document.getElementById("countdowntimer").innerHTML=xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET","forajax/load_timer.php",true);
            xmlhttp.send(null);
            
        }
    </script>
</body>
</html>
