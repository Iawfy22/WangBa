<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>上机/下机</title>
    <link rel="stylesheet" href="../css/shangji.css">
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
                        <li><a href="Recharge.php">余额充值</a></li>
                        <li><a href="Logout.php">账户注销</a></li>
                    </ul>
                </li>
                <li><a href="contact_us.php">帮助中心</a></li>
            </ul>
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
        <?php
        if ($row['status'] == 0)  // 离线状态，需要上机
        {
        ?>
<!--            上机页面-->
            <h2>请选择机器，开始上机！</h2>
            <br>
            <table>
                <thead>
                <tr>
                    <th>电脑状态</th>
                    <th>电脑编号</th>
                    <th>小时单价</th>
                    <th>是否预约</th>
                </tr>
                </thead>
            <?php
            include_once "../backend/conn.php";
            // 查询
            $sql = "SELECT * FROM computer_information order by computer_id ASC";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    if($row['status'] == 0)  // 未使用
                    {
                        echo "<tr>";
                        echo "<td><div class='status_free'>空闲</div></td>>
                            <td>". $row['computer_id']. "</td>
                            <td>". $row['money'] ."元</td>";

                        echo "<td>
                                <form method='post' action='../backend/shangji.php'>
                                    <input type='hidden' name='id' value='{$row['computer_id']}'>
                                    <button type='submit' value='确认'>确认</button>
                                </form>
                                </td>";
                        echo "</tr>";
                    }
                    elseif ($row['status'] == 1)  //正在使用
                    {
                        echo "<tr><td><div class='status_used'>使用中</div></td>><td>". $row['computer_id'] ."</td><td>". $row['money'] ."元</td><td>不可选择 </td></tr>";
                    }
                    else  //维修中
                    {
                        echo "<tr><td><div class='status_maintenance'>维修中</div></td>><td>". $row['computer_id'] ."</td><td>". $row['money'] ."元</td><td>不可选择 </td></tr>";
                    }
                }
            }
            ?>
            </table>
        <?php
        }
        else
        {
        ?>
<!--        目前在线-->
<!--        打印上机时间和当前费用-->
        <h2>当前正在上机</h2>
            <br>
            <br>
            <?php
                include_once "../backend/conn.php";

                $sql = "SELECT * FROM shangji_information where user_name = '". $_SESSION['username']."' AND is_end = 0";
                $result = mysqli_query($conn, $sql);
                if(@mysqli_num_rows($result) > 0)
                {
                    $row = @mysqli_fetch_assoc($result);
                    $computer_id = $row['computer_id'];
                    $money_hour = $row['money_hour'];
                    $start_time = $row['start_time'];
                    $user_name = $row['user_name'];
                    $shangji_id = $row['id'];
                }

                // 查询配置
            $sql = "SELECT * FROM computer_information where computer_id = '$computer_id'";
                $result = mysqli_query($conn, $sql);
                if(@mysqli_num_rows($result) > 0)
                {
                    $row = @mysqli_fetch_assoc($result);
                    $peizhi = $row['peizhi'];
                }

                // 查询余额
            $sql = "SELECT * FROM user_info where user_name = '$user_name'";
                $result = mysqli_query($conn, $sql);
                if(@mysqli_num_rows($result) > 0)
                {
                    $row = @mysqli_fetch_assoc($result);
                    $money = $row['money'];
                }
            ?>
            <table>
                <tr>
                    <td>选择的设备编号</td>
                    <td><?php echo $computer_id; ?></td>
                </tr>
                <tr>
                    <td>设备配置信息</td>
                    <td><?php echo $peizhi; ?></td>
                </tr>
                <tr>
                    <td>设备每小时价格</td>
                    <td><?php echo $money_hour; ?></td>
                </tr>
                <tr>
                    <td>上机时长</td>
                    <td>
                        <p id="time_difference"> </p>
                    </td>
                </tr>
                <tr>
                    <td>账户余额</td>
                    <td><?php echo $money; ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <form action="../backend/xiaji.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $shangji_id;?>">
                            <button type="submit">下机</button>
                        </form>
                    </td>
                </tr>
            </table>
        <?php
        }
        ?>
    </div>
</div>

<script>
    // 自动更新当前时间
    function updateTime() {
        const now = new Date();
        const formattedTime = now.toLocaleString();
        document.getElementById('currentTime').innerText = `当前时间: ${formattedTime}`;
    }
    function updateTime2() {
        const timestamp1 = <?php echo $start_time; ?>; // 确保这是一个Unix时间戳
        const timestamp2 = Math.floor(Date.now() / 1000);
        const timeDifferenceElement = document.getElementById('time_difference');

        // 计算时间差（秒）
        const differenceInSeconds = timestamp2 - timestamp1;

        // 将秒转换为天数、小时数、分钟数
        const days = Math.floor(differenceInSeconds / (24 * 3600));
        const hours = Math.floor((differenceInSeconds % (24 * 3600)) / 3600);
        const minutes = Math.floor((differenceInSeconds % 3600) / 60);

        // 更新页面上的时间差
        timeDifferenceElement.textContent = `${days}天 ${hours}小时 ${minutes}分钟`;
    }

    setInterval(updateTime, 1000); // 更新当前时间
    setInterval(updateTime2, 1000); // 持续更新上机时长

    updateTime(); // 初始化时间
    updateTime2(); // 初始化上机时长
</script>
</body>
</html>