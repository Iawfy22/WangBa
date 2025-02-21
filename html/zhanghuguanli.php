<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户主页</title>
    <link rel="stylesheet" href="../css/zhanghuguanli.css">
</head>
<body>
<!-- 顶部栏 -->
<div class="header">
    <img src=../pic/headpic.png class="image">
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
            <ul>
                <li><a href="user_message.php">用户信息</a></li>
                <li><a href="shangji.php">上机/下机</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">账户管理</a>
                    <ul class="dropdown-content">
                        <li><a href="Modify_password.php">修改密码</a></li>
                        <li><a href="Complete_Info.php">信息完善</a></li>
                        <li><a href="Recharge.php">信息完善</a></li>
                        <li><a href="Logout.php">账户注销</a></li>
                    </ul>
                </li>
                <li><a href="contact_us.php">帮助中心</a></li>
            </ul>
        </ul>
    </div>

    <!-- 右侧内容区域 -->
    <div class="content">
<!--        <h2>请选择您需要的</h2>-->
        <table>
            <tr>
                <td>
                    <button class="button" onclick="navigateTo('userModify.php?action=change_password')">修改密码</button>
                </td>
                <td>
                    <button class="button" onclick="navigateTo('userModify.php?action=recharge')">余额充值</button>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="button" onclick="navigateTo('userModify.php?action=complete_info')">信息完善</button>
                </td>
                <td>
                    <button class="button" onclick="navigateTo('userModify.php?action=logout')">账户注销</button>
                </td>
            </tr>
        </table>
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

    function navigateTo(url) {
        window.location.href = url;
    }
</script>
</body>
</html>
