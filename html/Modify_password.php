<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户主页</title>
    <link rel="stylesheet" href="../css/Modify_password.css">
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
    <div class="content">
        <h2>密码修改</h2>
        <br>
        <br>
        <form action="../backend/Modify_password.php" method="post">
            <table>
                <tr>
                    <td width="150px"><label>请输入原始密码：</label></td>
                    <td><input type="password" name="pw_original"></td>
                </tr>
                <tr>
                    <td><label>请输入新密码：</label></td>
                    <td><input type="password" name="pw_new1"></td>
                </tr>
                <tr>
                    <td><label>请确认新密码：</label></td>
                    <td><input type="password" name="pw_new2"></td>
                </tr>
                <tr>
                    <td><button type="submit">确认</button></td>
                    <td><button type="reset">重置</button></td>
                </tr>
            </table>
        </form>
    </div>
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
