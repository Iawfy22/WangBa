<?php
session_start();
$user_name = $_SESSION['username'];
include_once "conn.php";

$sql = "SELECT * FROM user_info WHERE user_name = '$user_name'";
$result = mysqli_query($conn, $sql);
if(!$result)
{
    echo "<script>alert('操作失败！');history.back();</script>";
    exit;
}

// 是否处于上机状态
$row = $result->fetch_assoc();
$status = $row['status'];
if ($status != 0)
{
    echo "<script>alert('请您先下机');history.back();</script>";
    exit;
}

// 删除用户信息
$sql = "DELETE FROM user_info WHERE user_name = '$user_name'";
$result = mysqli_query($conn, $sql);
if($result)
{
    echo "<script>alert('账户注销成功');location.href='../html/index.php'</script>";
}
