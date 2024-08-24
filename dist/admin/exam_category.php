<?php
session_start();
require '../config.php';

if (!empty($_SESSION["id"])) {
    $teacher_id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM exam_category WHERE tid=$teacher_id");
} else {
    header("location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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
                <a href="Dashboard.php" class=" block py-2.5 px-4 rounded transition duration-200 hover:bg-green-700 hover:text-white">Dashboard</a>
                <a href="exam_category.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-700 hover:text-white">Add & Edit Quiz</a>
                <a href="add_edit_exam_questions.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-700 hover:text-white">Add & Edit Questions</a>
                <a href="../logout.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-700 hover:text-white">Log Out</a>
            </nav>
        </div> -->

        <!-- Content -->
        <form name="form1" action="" method="post" class="flex flex-col flex-1 overflow-hidden ">
            <div class="flex flex-col flex-1 overflow-hidden ">
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container px-6 py-8 mx-auto lg:ml-3">
                        <div class="flex flex-wrap items-center justify-center max-w-6xl mx-auto sm:px-8">
                            <div class="w-full px-4 lg:w-3/4 ">
                                <div class="p-5 bg-white rounded-lg shadow-lg">
                                    <h2 class="mb-6 text-xl font-semibold">Add Quiz</h2>
                                    <div class="mb-4">
                                        <label class="block mb-2 text-sm font-bold text-gray-700" for="quiz-category">Add Quiz Category</label>
                                        <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="quiz-category" type="text" placeholder="New Quiz Category" name="examname">
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-2 text-sm font-bold text-gray-700" for="quiz-time">Quiz Time in Minutes</label>
                                        <input class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="quiz-time" type="number" placeholder="Quiz Time in Minutes" name="examtime">
                                    </div>
                                    <input type="submit" name="submit1" value="Add Quiz" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline">
                                </div>
                            </div>
                            <div class="w-full px-4 mt-6 lg:w-3/4 lg:mt-3">
                                <div class="p-5 bg-white rounded-lg shadow-lg">
                                    <h2 class="mb-6 text-xl font-semibold">Quiz</h2>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full leading-normal">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">#</th>
                                                    <th scope="col" class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">Quiz Name</th>
                                                    <th scope="col" class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">Quiz Time</th>
                                                    <th scope="col" class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">Edit</th>
                                                    <th scope="col" class="px-5 py-3 text-xs font-semibold tracking-wider text-center text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 0;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $count++;
                                                    ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td class="text-center"><?php echo $row["category"]; ?></td>
                                                        <td class="text-center"><?php echo $row["exam_time_in_minutes"]; ?></td>
                                                        <td class="text-center"><a href="edit_exam.php?id=<?php echo $row["id"]; ?>" class="text-green-600 hover:text-green-900">Edit</a></td>
                                                        <td class="text-center"><a href="delete.php?id=<?php echo $row["id"]; ?>" class="text-red-600 hover:text-red-900">Delete</a></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </form>
    </div>
    <script src="https://unpkg.com/@themesberg/flowbite@1.1.1/dist/flowbite.bundle.js"></script>

</body>

<?php
if (isset($_POST["submit1"])) {
    mysqli_query($conn, "INSERT INTO exam_category VALUES (NULL,'$_POST[examname]','$_POST[examtime]','$teacher_id')") or die(mysqli_error($conn));
    ?>
    <script type="text/javascript">
        alert("Quiz Added Successfully");
        window.location.href = window.location.href;
    </script>
<?php
}
?>

</html>
