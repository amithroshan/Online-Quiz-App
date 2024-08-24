<?php
session_start();
if(!isset($_SESSION["id"]))
{
    ?>
    <script type="text/javascript">
        window.location="../index.php"
    </script>
    <?php
}
?>

<?php
require '../config.php';
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <link rel="icon" href="44.jpg" type="image/x-icon">

    <!-- css link -->
    <link rel="stylesheet"  href="select_exam.css">
    
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
        <?php
        $res=mysqli_query($conn,"select * from exam_category");
        while($row=mysqli_fetch_array($res))
        {
            ?>
            <input type="button" class="main-button" value="<?php echo $row["category"]; ?>" onclick="set_exam_type_session(this.value);">
            <?php
        }
        ?>
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
    <script type="text/javascript">
        function set_exam_type_session(exam_category) {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    window.location="dashboard.php";
                }
            };
            xmlhttp.open("GET","forajax/set_exam_type_session.php?exam_category="+ exam_category,true);
            xmlhttp.send(null);
            
        }
    </script>
</body>
</html>
