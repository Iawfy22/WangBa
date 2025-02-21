<?php
// 使用全局数组$_POST获取前端数据
$username = trim($_POST['username']);
//echo $username;
$id = trim($_POST['id']);
$password = trim($_POST['password']);
$password2 = trim($_POST['password2']);
$user_sex = $_POST['user_sex'];
$money = $_POST['money'];

// 连接数据库
include_once "conn.php";

// 验证输入信息是否有效
$sql = "select * from user_info where user_id = '$id'";
$result = mysqli_query($conn, $sql);
if (!preg_match('/^\d{17}[0-9Xx]$/',$id))
{
    echo "<script>alert('身份证号格式存在问题');history.back()</script>')";
    exit;
}
if (mysqli_num_rows($result) > 0)  //用户不重复
{
    echo "<script>alert('该身份已注册');history.back()</script>')";
    exit;
}
if($password <> $password2)  //两次密码是否相等
{
    echo "<script>alert('两次密码输入不一致');history.back()</script>')";
    exit;
}
if (!preg_match('/^[a-zA-Z0-9]{6,20}$/',$password))
{
    echo "<script>alert('密码只能是大小写字母或数字，长度为6--20！');history.back()</script>')";
    exit;
}
$sql= "select * from user_info where user_name = '$username'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)  //用户名不重复
{
    echo "<script>alert('用户名已被占用！');history.back()</script>')";
    exit;
}

// 写入数据库
$sql = "insert into user_info (user_id, user_name, user_pw, user_sex, money, create_time) values ('$id', '$username', '" . md5($password). "', '$user_sex', '$money', '".time()."')";
// 执行
$result = mysqli_query($conn, $sql);
if($result){
    echo "<script>alert('注册成功');location.href='../html/userLogin.php'</script>";
}





