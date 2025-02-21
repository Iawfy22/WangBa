<?php
$computer_id = $_POST["computer_id"];


include_once  "conn.php";

$sql = "UPDATE computer_information SET status = '0' WHERE computer_id = $computer_id";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>alert('维修成功');location.href='../html/computer_repair.php'</script>";
}