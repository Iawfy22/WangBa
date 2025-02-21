<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>网吧管理系统</title>
    <link rel="stylesheet" href="../css/facilities.css">
</head>
<body>
<div class="container">
    <!--    <h1>欢 迎 来 到 天 地 网 吧</h1>-->
    <div class="header">
        <h1>欢 迎 来 到 天 地 网 吧</h1>
    </div>
    <div class="nav">
        <ul>
            <li><a href="index.php">首页</a></li>
            <li><a href="gonggao.php">公告消息</a></li>
            <li><a href="facilities.php">设备信息</a></li>
            <li><a href="index_recharge.php">充值管理</a></li>
            <li><a href="userLogin.php">登录/注册</a>
                <ul class="dropdown">
                    <li><a href="userLogin.php">用户登录</a> </li>
                    <li><a href="managerLogin.php">管理员登录</a> </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="main">
        <h2>电脑信息</h2>
        <br>
        <table>
            <thead>
            <tr>
                <td>电脑编号</td>
                <td>电脑单价</td>
                <td>电脑配置信息</td>
                <td>使用寿命</td>
            </tr>
            </thead>
        <?php
        include_once "../backend/conn.php";
        $sql = "SELECT * FROM computer_information order by computer_id ASC ";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td> ".$row['computer_id']."</td>";
            echo "<td> ".$row['money']."</td>";
            echo "<td> ".$row['peizhi']."</td>";
            echo "<td>999</td>";
            echo "</tr>";
        }
        ?>
        </table>
    </div>
</div>
</body>
</html>
