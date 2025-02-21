<?php

$user_name = $_POST['username'];
$recharge_money = $_POST['recharge_money'];

include_once "conn.php";


// 查询账户
$sql="select * from user_info where user_name='$user_name'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) == 0){
    echo "<script>alert('用户名输入有误'); history.back();</script>";
    exit(0);
}

// 修改余额
$rows = mysqli_fetch_array($result);
$money = $rows['money'];
$money = $money + $recharge_money;

$sql = "UPDATE user_info SET money='$money' WHERE user_name='$user_name'";
$result = mysqli_query($conn,$sql);
if(mysqli_affected_rows($conn) == 1){
    echo "<script>alert('充值成功！当前账户余额" . $money ."');location.href='../html/index.php'</script>";
}

