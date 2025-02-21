<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>用户信息</title>
    <link rel="stylesheet" href="../css/Recharge.css">
</head>
<body>
<!-- 顶部栏 -->
<div class="header">
    <img src=../pic/headPic.png class="image">
    &nbsp;&nbsp;&nbsp;
    <p>用户: <?php echo $_SESSION['username'] ?> </p>
    &nbsp;&nbsp;&nbsp;
    <p id="currentTime">当前时间: </p>
</div>

<!-- 主内容区域 -->
<div class="main-container">
    <!-- 左侧导航栏 -->
    <div class="sidebar">
        <ul>
            <li><a href="user_message.php">用户信息</a></li>
            <li><a href="shangji.php">上机/下机</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">账户管理</a>
                <ul class="dropdown-content">
                    <li><a href="Modify_password.php">修改密码</a></li>
                    <li><a href="Complete_Info.php">信息完善</a></li>
                    <li><a href="Recharge.php">余额充值</a></li>
                    <li><a href="Logout.php">账户注销</a></li>
                </ul>
            </li>
            <li><a href="contact_us.php">帮助中心</a></li>
        </ul>
    </div>

    <!-- 右侧内容区域 -->
    <?php
    //    echo $_SESSION['username'];
    $conn = mysqli_connect("localhost","root","zyf20040223", "database_course");

    if(!$conn)  // 数据库连接不成功
    {
        die("数据库连接失败");
    }
    // 设置字符集
    mysqli_query($conn, "SET NAMES utf8");
    $sql = "select * from user_info where user_name = '". $_SESSION['username']."'";
    $result = @mysqli_query($conn, $sql);
    if(@mysqli_num_rows($result) > 0)
    {
        $row = @mysqli_fetch_assoc($result);
    }
    ?>
    <div class="content">
        <h2>余额充值</h2>
        <br>
        <br>
        <form action="../backend/Recharge.php" method="post">
            <table>
                <?php
                include_once "../backend/conn.php";
                $sql = "select money from user_info where user_name = '". $_SESSION['username']."'";;
                $result = @mysqli_query($conn, $sql);
                if(@mysqli_num_rows($result) > 0)
                {
                    $row = @mysqli_fetch_assoc($result);
                    $money = $row['money'];
                }
                ?>
                <tr>
                    <td width="200px"><label>当前账户余额：</label></td>
                    <td><?php echo $money?>元</td>
                </tr>
                <tr>
                    <td><label>请输入需要充值的金额：</label></td>
                    <td><input type="text" name="recharge_money"></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">确认</button></td>
                </tr>
            </table>
        </form>
</div>

<script>
    // 自动更新当前时间
    function updateTime() {
        const now = new Date();
        const formattedTime = now.toLocaleString();
        document.getElementById('currentTime').innerText = `当前时间: ${formattedTime}`;
    }
    setInterval(updateTime, 1000);
    updateTime(); // 初始化时间
</script>
</body>
</html>
