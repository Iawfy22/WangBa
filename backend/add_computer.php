<?php

$peizhi = $_POST["peizhi"];
$money = $_POST["money"];

// 检查是不是数字
if (!is_numeric($money) || $money <= 0)
{
    echo "<script>alert('价格输入不正确！');history.back();</script>";
    exit;
}

include_once "conn.php";
$sql = "INSERT INTO computer_information (peizhi,money, status, history_time) VALUES ('$peizhi','$money', '0', '0')";
$result = mysqli_query($conn,$sql);
//echo $result;
if ($result)
{
    echo "<script>alert('添加成功');location.href='../html/computer_add.php'</script>";
}
else
{
    echo "<script>alert('操作失败');history.back();</script>";
    exit;
}
