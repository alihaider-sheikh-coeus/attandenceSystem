
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
</head>
<body>

<a href="index.php" class="btn btn-info">Back </a>
<a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</body>
</html>


<?php
session_start();
//var_dump( $_SESSION["loggedin"]);
// Check if the user is logged in, if not then redirect him to login page
//if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//    header("location: login.php");
//    exit;
//}
include 'db_connection.php';
$conn = OpenConn();

$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
//    echo $result;
$results_per_page = 2;
$number_of_result = mysqli_num_rows($result);

//determine the total number of pages available
$number_of_page = ceil($number_of_result / $results_per_page);
//determine which page number visitor is currently on
if (!isset ($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

//determine the sql LIMIT starting number for the results on the displaying page
$page_first_result = ($page - 1) * $results_per_page;
$query = "SELECT * FROM employees LIMIT " . $page_first_result . ',' . $results_per_page;
$result = mysqli_query($conn, $query);
//var_dump($result->num_rows);
if ($result->num_rows > 0) {
    echo "<table><tr><th>Email</th><th>Name</th><th>Designation</th><th>Salary</th><th>Boss Name</th><th>Image</th></th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $image = $row['image'];
        $image_src = "uploads/" . $image;
        echo "<tr><td class='Email_id'>" . $row["EMAIL"] . "</td>
<td class='name'>" . $row["name"] . "</td>
<td class='designation'>" . $row["designation_id"] . "</td>
<td class='salary'>" . $row["salary"] . "</td>
<td class='boss'>" . $row["boss_id"] . "</td>
<td class='image'><img class ='profile_image' src='" . $image_src . "' alt='' border=3 height=100 width=100></td> 
<td> <button class='edit' id='edit' >edit</button> 
     <button class='delete'  id='delete' >delete</button> 
                </td></tr>";
    }
    echo "</table>";
} else {
    //echo "0 results";
}
for ($page = 1; $page <= $number_of_page; $page++) {
    echo '<a class="pagination"  href = "showEmployee.php?page='  . $page . '">' . $page . ' </a>';
}
CloseCon($conn);

?>

