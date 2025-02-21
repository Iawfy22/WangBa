<?php
session_start();

$manager_name = $_POST['manager_name'];
$job = $_POST['job'];
$salary = $_POST['salary'];

if($manager_name == "")
{
    echo "<script>alert('请输入员工昵称');history.back()</script>')";
    exit;
}
if (empty($job) && empty($salary)) {
    echo "<script>alert('请正确输入相关信息');history.back()</script>')";
    exit;
}
include_once "conn.php";

$sql = "SELECT * FROM manager_info WHERE manager_name='$manager_name'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('该员工不存在');history.back()</script>')";
    exit;
}

// 检查职位
if($job != "")
{
    if($job != "经理" && $job != "员工" && $job != "清洁人员")
    {
        echo "<script>alert('职位输入不正确');history.back()</script>')";
        exit;
    }
}
// 检查薪资
if($salary != "")
{
    if(!is_numeric($salary) || $salary < 0)
    {
        echo "<script>alert('请输入正确的薪资');history.back()</script>')";
        exit;
    }
}
// 信息修改
if($job == "" && $salary != "")
{
    // 只修改salary
    $sql = "UPDATE manager_info SET salary='$salary' WHERE manager_name='$manager_name'";
}
elseif ($job != "" && $salary == "")
{
    // 只修改job
    $sql = "UPDATE manager_info SET job='$job' WHERE manager_name='$manager_name'";
}
else
{
    $sql = "UPDATE manager_info SET job='$job', salary='$salary' WHERE manager_name='$manager_name'";
}
$result = mysqli_query($conn, $sql);
if($result)
{
    echo "<script>alert('修改成功');location.href='../html/modify_manager.php'</script>";
}
