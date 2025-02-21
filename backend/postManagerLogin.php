<?php

session_start();  // session全局数组
$manager_name = trim($_POST['manager_name']);
$password = trim($_POST['password']);

// 连接数据库
include include_once "conn.php";

// 查询
$sql = "SELECT * FROM manager_info WHERE manager_name = '$manager_name' and password = '". md5($password). "'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $manager_name = $row['manager_name'];  // 用户名
    $_SESSION['manager_name'] = $manager_name;
    echo "<script>alert('登录成功');location.href='../html/manager_index.php'</script>";
}
else{
    echo "<script>alert('用户名或密码不正确');history.back();</script>";
}

