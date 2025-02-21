<?php

$id = $_POST['id'];

include_once  "conn.php";

$sql = "SELECT * FROM shangji_information WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) <= 0){
    echo "<script>alert('下机失败！');history.back();</script>";
    exit;
}

$row = mysqli_fetch_assoc($result);
$user_name = $row['user_name'];
$computer_id = $row['computer_id'];
$money_hour = $row['money_hour'];
$start_time = $row['start_time'];
// 结束上机
$end_time = time();
# 计算费用
$time_difference = $end_time - $start_time;
$total_hours = $time_difference / 3600;
$total_money = $total_hours * $money_hour;

// 改变用户状态
$sql = "SELECT * FROM user_info WHERE user_name = '$user_name'";
$result = mysqli_query($conn, $sql);
if(!$result){
    echo "<script>alert('下机失败！4');history.back();</script>";
    exit;
}
$row = mysqli_fetch_assoc($result);
$user_yue = $row['money'];
$yue_new = $user_yue - $total_money;
$sql = "UPDATE user_info SET status = 0, money='$yue_new' WHERE user_name = '$user_name'";
$result = mysqli_query($conn, $sql);
if(!$result)
{
    echo "<script>alert('下机失败！1');history.back();</script>";
    exit;
}
// 改变电脑状态
$sql = "SELECT * FROM computer_information WHERE computer_id = '$computer_id'";
$result = mysqli_query($conn, $sql);
if(!$result)
{
    echo "<script>alert('下机失败！2');history.back();</script>";
    exit;
}
$row = mysqli_fetch_assoc($result);
$history_time = $row['history_time'] + $total_hours;
if($history_time >= 300)  // 需要维修
{
    $sql = "UPDATE computer_information SET status = 2, history_time = '$history_time' WHERE computer_id = '$computer_id'";
}
else  // 不需要维修
{
    $sql = "UPDATE computer_information SET status = 0,history_time = '$history_time' WHERE computer_id = '$computer_id'";
}
$result = mysqli_query($conn, $sql);
if(!$result)
{
    echo "<script>alert('下机失败！3');history.back();</script>";
    exit;
}

// 修改上机信息
$sql = "UPDATE shangji_information SET end_time = '$end_time',total_money = '$total_money', total_time = '$total_hours', is_end = 1 WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    if($yue_new <= 0)
    {
        echo "<script>alert('下机成功，请注意充值！');location.href='../html/shangji.php'</script>";
    }
    else
    {
        echo "<script>alert('下机成功，当前余额".$yue_new."');location.href='../html/shangji.php'</script>";
    }
}
