<?php
include "db_connection.php";
if(!empty($_POST['ending_date']) && !empty($_POST['starting_date']) ) {
    $starting_date = $_POST['starting_date'];
    $ending_date = $_POST['ending_date'];
    showReport($starting_date,$ending_date);

}
function showReport($starting_date,$ending_date)
{

    $conn = OpenConn();
    $sql="select status,count(*) as counter from roll_in where today_attandence >= '".date($starting_date)."' and today_attandence <= '".date($ending_date)."' group by status ";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        echo "<table ><tr><th>status</th><th>Counter</th></tr>";
        while ($row = $result->fetch_assoc()) {

            echo " <tr><td class='status'>" . $row["status"] . "</td>
                    <td class='counter'>" . $row["counter"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    CloseCon($conn);
}