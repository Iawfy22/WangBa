<?php
$manager_name = $_POST['manager_name'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$job = $_POST['job'];
$id = $_POST['id'];
$salary = $_POST['salary'];

include_once "conn.php";

// 信息检查
$sql = "SELECT * FROM manager_info WHERE manager_name = '$manager_name'";
$result = mysqli_query($conn, $sql);
// 管理员姓名不重复
if (mysqli_num_rows($result) > 0)
{
    echo "<script>alert('该身份已注册');history.back()</script>')";
    exit;
}
// 身份证号正确
if (!preg_match('/^\d{17}[0-9Xx]$/',$id))
{
    echo "<script>alert('身份证号格式存在问题');history.back()</script>')";
    exit;
}
if ($password != '123456')
{
    echo "<script>alert('初始密码请设置为123456');history.back()</script>')";
    exit;
}
if($job != '经理' && $job != '员工' && $job != '清洁人员')
{
    echo "<script>alert('请正确书写管理员职位');history.back()</script>')";
    exit;
}
// 执行
$sql = "INSERT INTO manager_info (manager_id, job, password, manager_name, phone, salary) values ('$id', '$job', '".md5($password)."', '$manager_name', '$phone', '$salary')";
$result = mysqli_query($conn, $sql);
if($result)
{
    echo "<script>alert('添加成功');location.href='../html/manager_current.php';</script>";
}
else
{
    echo "<script>alert('注册失败');history.back()</script>";
}