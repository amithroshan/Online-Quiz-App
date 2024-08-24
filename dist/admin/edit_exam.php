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
$res=mysqli_query($conn,"select * from exam_category where id=$id");
while($row=mysqli_fetch_array($res)){
    $exam_category=$row["category"];
    $exam_time=$row["exam_time_in_minutes"];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz</title>
    <link href="../../src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
    
            
                    <div class="flex justify-center w-2/3 m-10 mx-auto mt-20 h-1/2">
                            <div class="w-full p-5 bg-white rounded-lg shadow-lg">
                            <form name="form1" action="" method="post">
                                        <div class="mb-4">
                                            <h2 class="text-2xl font-semibold text-gray-700">Edit Quiz</h2>
                                        </div>
                                        <div class="mb-4">
                                            <label for="company" class="block mb-2 text-sm font-bold text-gray-700">New Quiz Category</label>
                                            <input type="text" id="category" name="examname" value="<?php echo $exam_category ?>" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required>
                                        </div>
                                        <div class="mb-6">
                                            <label for="vat" class="block mb-2 text-sm font-bold text-gray-700">Quiz Time in Minutes</label>
                                            <input type="number" id="time" name="examtime" value="<?php echo $exam_time ?>" class="w-full px-3 py-2 mb-3 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" required>
                                        </div>
                                        <div class="flex items-center justify-between">
                                        <input type="submit" name="submit1" value="Update Quiz" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline">
                                        </div>
                                </form>
                            </div>
                    </div>
            
    </div>
    <script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>

</body>
</html>

<?php
if (isset($_POST["submit1"]))
{
    mysqli_query($conn,"update exam_category set category='$_POST[examname]',exam_time_in_minutes='$_POST[examtime]' where id=$id") or die(mysqli_error($conn));
    ?>
    <script type="text/javascript">
        window.location="exam_category.php";
    </script>
    <?php
}
?> 