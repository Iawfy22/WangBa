<?php

$user_name = $_POST['username'];
$user_id = $_POST['id'];

include_once 'conn.php';

$sql = "SELECT * FROM user_info WHERE user_name = '$user_name' AND user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // 重置密码为123456
    $pw = 123456;
    $sql = "UPDATE user_info SET user_pw = '".md5($pw)."' WHERE user_name = '$user_name'";
    $result = mysqli_query($conn, $sql);
    echo "<script>alert('密码已重置，请及时修改');location.href='../html/userLogin.php'</script>";
}
else{
    echo "<script>alert('输入信息不正确或该账户不存在');history.back();</script>";
    exit;
}

