<?php
require '../config.php';
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM student WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("location: ../index.php");
}

$id=$_GET["id"];
$id1=$_GET["id1"];

$question="";
$opt1="";
$opt2="";
$opt3="";
$opt4="";
$answer="";

$res=mysqli_query($conn,"select * from questions where id=$id");
while($row=mysqli_fetch_array($res)){
    $question=$row["question"];
    $opt1=$row["opt1"];
    $opt2=$row["opt2"];
    $opt3=$row["opt3"];
    $opt4=$row["opt4"];
    $answer=$row["answer"];
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Questions</title>
<!-- Tailwind CSS -->
<link href="../../src/output.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100">

<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
      <a href="exam_category.php" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="image/aa.png" class="h-8" alt="Flowbite Logo" />
      </a>
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
      </button>
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <a href="Dashboard.php" class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Dashboard</a>
          </li>
          <li>
            <a href="exam_category.php" class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Add & Edit Quiz</a>
          </li>
          <li>
            <a href="add_edit_exam_questions.php" class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Add & Edit Questions</a>
          </li>
          <li>
            <a href="../logout.php" class="block px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> 
  
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <!-- <div class="absolute inset-y-0 left-0 w-64 px-2 space-y-6 text-white transition duration-200 ease-in-out transform -translate-x-full bg-green-900 py-7 md:relative md:translate-x-0">
            <a href="#" class="flex items-center px-4 space-x-2 text-white">
                
                <span class="text-2xl font-extrabold">Admin Panel</span>
            </a>
            <nav>
                <a href="Dashboard.php"                           class=" block py-2.5 px-4 rounded transition duration-200 hover:bg-green-700 hover:text-white">Dashboard</a>
                <a href="exam_category.php"           class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-700 hover:text-white">Add & Edit Quiz</a>
                <a href="add_edit_exam_questions.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-700 hover:text-white">Add & Edit Questions</a>
                <a href="../logout.php"          class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-700 hover:text-white">Log Out</a>
            </nav>
        </div> -->
    <div class="container max-w-6xl px-2 mx-auto sm:px-8">
        <div class="py-8">
                <div>
                <h2 class="text-2xl font-semibold leading-tight">Update Questions</h2>
                </div>
                <div class="px-2 py-2 my-2 overflow-x-auto bg-white rounded-lg shadow">
                        <div class="flex flex-col">
                            <form name="form1" action="" method="post">
                                <div class="flex flex-col md:flex-col">
                                    <label for="question" class="mx-2">Edit Question:</label>
                                    <input type="text" id="question" class="p-2 m-2 bg-gray-200 border border-gray-300 rounded" placeholder="Add Question" name="question" value="<?php echo $question; ?>">
                                
                                    <label for="opt1" class="mx-2">Edit Option 1:</label>
                                    <input type="text" id="opt1" class="p-2 m-2 bg-gray-200 border border-gray-300 rounded" placeholder="Add option 1" name="opt1" value="<?php echo $opt1; ?>">
                                
                                    <label for="opt2" class="mx-2">Edit Option 2:</label>
                                    <input type="text" id="opt2" class="p-2 m-2 bg-gray-200 border border-gray-300 rounded" placeholder="Add option 2" name="opt2" value="<?php echo $opt2; ?>">
                                
                                    <label for="opt3" class="mx-2">Edit Option 3:</label>
                                    <input type="text" id="opt3" class="p-2 m-2 bg-gray-200 border border-gray-300 rounded" placeholder="Add option 3" name="opt3" value="<?php echo $opt3; ?>">
                                
                                    <label for="opt4" class="mx-2">Edit Option 4:</label>
                                    <input type="text" id="opt4" class="p-2 m-2 bg-gray-200 border border-gray-300 rounded" placeholder="Add option 4" name="opt4" value="<?php echo $opt4; ?>">
                                
                                    <label for="answer" class="mx-2">Edit Answer:</label>
                                    <input type="text" id="answer" class="p-2 m-2 bg-gray-200 border border-gray-300 rounded" placeholder="Add Answer" name="answer" value="<?php echo $answer; ?>">
                                </div>
                                    </div class="text-center">
                                <input type="submit" name="submit1" value="Update Question" class="max-w-xl py-2 mx-auto my-5 text-base font-medium text-white bg-green-500 rounded-md shadow-sm px-44 hover:bg-green-700">
                            </div>
                        </form>
                        
            
                 </div>
        </div>
    </div>
    </div>
    <script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>

</body>
</html>
<?php
if (isset($_POST["submit1"]))
{
    mysqli_query($conn,"update questions set question='$_POST[question]',opt1='$_POST[opt1]',opt2='$_POST[opt2]',opt3='$_POST[opt3]',opt4='$_POST[opt4]',answer='$_POST[answer]' where id=$id") or die(mysqli_error($conn));
    ?>
    <script type="text/javascript">
        window.location="add_edit_questions.php?id=<?php echo $id1 ?>";
    </script>
    <?php
}
?>