<?php
session_start();

$user_name = $_SESSION['username'];
$recharge_money = $_POST['recharge_money'];

if (!is_numeric($recharge_money) || $recharge_money <= 0) {
    echo "<script>alert('请输入有效的充值金额');history.back();</script>";
    exit;
}

include_once 'conn.php';

$sql = "SELECT * from user_info WHERE user_name = '$user_name'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows == 0) {
    echo "<script>alert('充值失败，请检查当前状态');history.back();</script>";
    exit(0);
}
$row = $result->fetch_assoc();
$money = $row['money'];
$money = $money + $recharge_money;

$sql = "UPDATE user_info SET money = '$money' WHERE user_name = '$user_name'";
$result = $conn->query($sql);
if ($result) {
    echo "<script>alert('充值成功，当前余额为". $money ."');location.href='../html/Recharge.php'</script>";
}


