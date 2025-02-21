<?php

session_start();

$old_name = $_SESSION['manager_name'];
$manager_name = $_POST['manager_name'];
$phone = $_POST['phone'];
$manager_id = $_POST['manager_id'];

include_once "conn.php";
// 检查输入的有效性
if(!empty($manager_name))
{
    $sql = "SELECT * FROM manager_info WHERE manager_name = '$manager_name'";
    $result = mysqli_query($conn, $sql);
// 管理员姓名不重复
    if (mysqli_num_rows($result) > 0)
    {
        echo "<script>alert('该名称已存在');history.back()</script>')";
        exit;
    }
}
// 身份证号正确
if(!empty($manager_id))
{
    if (!preg_match('/^\d{17}[0-9Xx]$/',$manager_id))
    {
        echo "<script>alert('身份证号格式存在问题');history.back()</script>')";
        exit;
    }
}
// 联系方式是否正确
if(!empty($phone))
{
    if (!is_numeric($phone))
    {
        echo "<script>alert('联系方式格式存在问题');history.back()</script>')";
        exit;
    }
}

// 信息修改
if(empty($manager_name) && empty($phone) && !empty($manager_id))
{
    // 只修改身份证号
    $sql = "UPDATE manager_info SET manager_id = '$manager_id' WHERE manager_name = '$old_name' '";
}
elseif(empty($manager_name) && !empty($phone) && empty($manager_id))
{
    // 只修改联系方式
    $sql = "UPDATE manager_info SET phone = '$phone' WHERE manager_name = '$old_name' ";
}
elseif(!empty($manager_name) && empty($phone) && empty($manager_id))
{
    // 只修改昵称
    $sql = "UPDATE manager_info SET manager_name = '$manager_name' WHERE manager_name = '$old_name' ";
}
elseif(empty($manager_name) && !empty($phone) && !empty($manager_id))
{
    // 修改身份证号和联系方式
    $sql = "UPDATE manager_info SET phone = '$phone' and manager_id = '$manager_id' WHERE manager_name = '$old_name' ";
}
elseif (!empty($manager_name) && empty($phone) && !empty($manager_id))
{
    // 修改用户名和身份证号
    $sql = "UPDATE manager_info SET manager_name = '$manager_name' and manager_id = '$manager_id' WHERE manager_name = '$old_name' ";
}
elseif (!empty($manager_name) && !empty($phone) && empty($manager_id))
{
    // 修改昵称和联系方式
    $sql = "UPDATE manager_info SET manager_name = '$manager_name' and manager_id = '$manager_id' WHERE manager_name = '$old_name' ";
}
else
{
    // 全都修改
    $sql = "UPDATE manager_info SET phone = '$phone' and manager_id = '$manager_id' and manager_name = '$manager_name' WHERE manager_name = '$old_name' ";
}
$result = mysqli_query($conn, $sql);
if($result)
{
    echo "<script>alert('修改成功');location.href='../html/manager_index.php';</script>";
}