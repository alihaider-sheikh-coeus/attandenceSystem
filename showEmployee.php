

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
//$query = "select o.Email,o.name,o.salary,o.boss_id,o.image,d.name as designation_name  from employees o inner join designations d on o.designation_id = d.id ORDER BY `o.salary` DESC limit" . $page_first_result . ',' . $results_per_page;
$query = "select o.employee_id,o.email,o.name,o.salary,o.boss_name,o.image,d.name as designation_name  from employees o inner join designations d on o.designation_id = d.designation_id limit " . $page_first_result . ',' . $results_per_page;

$result = mysqli_query($conn, $query);
//var_dump($query);
if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Email</th><th>Name</th><th>Designation</th><th>Salary</th><th>Boss Name</th><th>Image</th></th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $image = $row['image'];
        $image_src = "uploads/" . $image;
        echo " <td class='id'>" . $row["employee_id"] . "</td>
<td class='Email_id'>" . $row["email"] . "</td>
<td class='name'>" . $row["name"] . "</td>
<td class='designation'>" . $row["designation_name"] . "</td>
<td class='salary'>" . $row["salary"] . "</td>
<td class='boss'>" . $row["boss_name"] . "</td>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
</head>
<body>
<div class="container">



    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form  method="post" action ="edit.php" enctype="multipart/form-data">
                     Modal Header
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <div class="modal-body">
                        <label for="employee_id">employee_id</label>  <input id="email" class="modal_id" type="text" name="id" readonly /><br>
                        <label for="email">Email</label>  <input id="email" class="modal_email" type="text" name="email" readonly /><br>
                        <label class="name">Name</label><input type="text" class="modal_name" name="name">
                        <br>
                        <label class="boss">boss</label>
                        <select name="boss" id="boss">
                            <option disabled selected>-- Select boss --</option>
                            <?php
//
                            $conn = OpenConn();// Using database connection file here
                            $records = "SELECT name From employees where designation_id ='2'";  // Use select query here
                            $result = mysqli_query($conn, $records);

                            if ($result->num_rows > 0) {
                                while ($data = $result->fetch_assoc()) {
                                    echo "<option value='" . $data['name'] . "'>" . $data['name'] . "</option>";  // displaying data in option menu
                                }
                            }
                            CloseCon($conn);
                            ?>
                        </select>
                        <br><label class="salary">Salary</label> <input type="text"  class="modal_salary" name="salary">
                        <label for="designation">Designation:</label>
                        <select name="designation" id="designation">
                            <option  disabled selected>Choose option</option>
                            <?php
                            //
                            $conn = OpenConn();// Using database connection file here
                            $records = "SELECT designation_id,name From designations ";  // Use select query here
                            $result = mysqli_query($conn, $records);

                            if ($result->num_rows > 0) {
                                while ($data = $result->fetch_assoc()) {
                                    echo "<option value='" . $data['designation_id'] . "'>" . $data['name'] . "</option>";  // displaying data in option menu
                                }
                            }
                            CloseCon($conn);
                            ?>
                        </select>
                        <label for="file-upload" class="custom-file-upload">
                            image</label><br>
                        <input id="file-upload" name="file-upload"  type="file"/><br>
                        <img class="modal_img" alt='' border=3 height=100 width=100></div>

                    <div class="modal-footer">
                        <button type="submit" name="modal_submit" class="btn btn-primary" id="save">Save</button>
                        <button type="button" class="btn btn-danger" id="hide">Close</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

</div>


<a href="index.php" class="btn btn-info">Back </a>
<a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</body>
</html>


