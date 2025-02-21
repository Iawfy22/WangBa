<?php
session_start();  // session全局数组
$username = trim($_POST['username']);
$password = trim($_POST['password']);


// 连接数据库
include_once "conn.php";

// 查询
$sql = "select * from user_info where user_name = '$username' and user_pw ='" . md5($password) . "'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==1)
{
    // 提取有效字段
    $row = mysqli_fetch_assoc($result);
    $username = $row['user_name'];  // 用户名
//    $money = $row['money'];   // 用户余额
//    $status = $row['status'];  // 状态
//    $create_time = $row['create_time'];  //创建时间
    $_SESSION['username'] = $username;
//    $_SESSION['money'] = $money;
//    if($status == 'offline')
//        $_SESSION['status'] = '离线';
//    else
//        $_SESSION['status'] = '在线';
//    $_SESSION['create_time'] = date('Y-m-d H:i:s', $create_time);
    echo "<script>alert('登录成功');location.href='../html/user_message.php'</script>";
}
else
{
    unset($_SESSION['username']);  // 销毁session
    echo "<script>alert('用户名或密码不正确');history.back();</script>";
}