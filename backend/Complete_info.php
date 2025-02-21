<?php
session_start();

$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$username = $_SESSION['username'];

include_once "conn.php";

// 判断电话号码是否合法——全为数字
if(!preg_match('/^[0-9]{5,15}$/',$phone)){
    echo "<script>alert('电话格式输入不正确！');history.back();</script>";
    exit;
}

// 判断邮箱格式输入是否合法
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "<script>alert('请输入有效的电子邮箱！');history.back();</script>";
    exit;
}

$sql = "UPDATE user_info SET phone='$phone',email='$email' WHERE user_name='$username'";
$result = mysqli_query($conn,$sql);
if($result)
{
    echo "<script>alert('操作成功');location.href='../html/user_index.php'</script>";
}
else
{
    echo "<script>alert('操作失败');location.href='../html/user_index.php'</script>";
    exit;
}