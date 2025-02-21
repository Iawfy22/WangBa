<?php
session_start();  // session全局数组
$username = $_SESSION['username'];
$pw_old = trim($_POST['pw_original']); // 原始密码
$pw_new1 = trim($_POST['pw_new1']);  // 新密码
$pw_new2 = trim($_POST['pw_new2']);  // 新密码

// 连接数据库
include_once "conn.php";

// 判断原始密码输入是否正确
$sql = "SELECT * FROM user_info WHERE user_name = '$username' and user_pw = '". md5($pw_old) ."'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 0)
{
    echo "<script>alert('原始密码输入不正确！');history.back();</script>";
    exit;
}
// 检查新密码是否合法
if (!preg_match('/^[a-zA-Z0-9]{6,20}$/',$pw_new1))
{
    echo "<script>alert('密码只能是大小写字母或数字，长度为6--20！');history.back()</script>')";
    exit;
}
// 检查两次密码输入是否一致
if($pw_new1 != $pw_new2)
{
    echo "<script>alert('两次密码输入不一致');history.back()</script>')";
    exit;
}
//判断新旧密码是否相等
if($pw_old == $pw_new1)
{
    echo "<script>alert('新密码不能与旧密码相等');history.back()</script>')";
    exit;
}

// 修改密码
$sql = "UPDATE user_info SET user_pw = '". md5($pw_new1) ."' WHERE user_name = '$username'";
$result = mysqli_query($conn, $sql);
if($result)
{
    echo "<script>alert('修改成功');location.href='../html/user_index.php'</script>";
}

