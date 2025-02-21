<?php
session_start();

$computer_id = trim($_POST['id']);
$username = trim($_SESSION['username']);

//echo $computer_id;
//echo $username;

if($computer_id == "" || $username == ""){
    echo "<script>alert('上机失败！5');history.back();</script>";
    exit;
}
include_once "conn.php";

// 先检查用户余额够不够
$sql = "SELECT * FROM user_info WHERE user_name = '$username'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $yue = $row['money'];
}
$sql = "SELECT * FROM computer_information WHERE computer_id = '$computer_id'";
$result = mysqli_query($conn, $sql);
if(!$result)
{
    echo "<script>alert('上机失败！3');history.back();</script>";
    exit;
}
$row = mysqli_fetch_assoc($result);
$money = $row['money'];

if ($money > $yue)
{
    echo "<script>alert('余额不足');history.back();</script>";
    exit;
}

// 将用户状态改为上机
$sql = "UPDATE user_info SET status = '1' WHERE user_name = '$username'";
$result = mysqli_query($conn, $sql);
if(!$result)
{
    echo "<script>alert('上机失败！1');history.back();</script>";
    exit;
}

// 更改电脑状态
$sql = "UPDATE computer_information SET status='1' WHERE computer_id = '$computer_id'";
$result = mysqli_query($conn, $sql);
if(!$result)
{
    echo "<script>alert('上机失败！2');history.back();</script>";
    exit;
}

$is_end = 0;
$sql = "INSERT INTO shangji_information (user_name,  computer_id, start_time, money_hour, is_end, end_time, total_time, total_money) VALUES ('$username', '$computer_id', '".time()."', '$money', '$is_end', 0, 0, 0)";
$result = mysqli_query($conn, $sql);
if(!$result)
{
    echo "<script>alert('上机失败！4');history.back();</script>";
    exit;
}
else
{
    echo "<script>alert('上机成功');location.href='../html/shangji.php'</script>";
}
