<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员主页</title>
    <link rel="stylesheet" href="../css/computer_usage.css">
</head>
<body>
<!-- 顶部栏 -->
<div class="header">
    <img src=../pic/headPic.png class="image">
    &nbsp;&nbsp;&nbsp;
    <p>管理员: <?php echo $_SESSION['manager_name'] ?> </p>
    &nbsp;&nbsp;&nbsp;
    <p id="currentTime">当前时间: </p>
</div>

<!-- 主内容区域 -->
<div class="main-container">
    <!-- 左侧导航栏 -->
    <div class="sidebar">
        <ul>
            <li><a href="manager_index.php">管理员首页</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">信息修改</a>
                <ul class="dropdown-content">
                    <li><a href="manager_info_modify.php">基本信息修改</a></li>
                    <li><a href="manager_modify_password.php">密码修改</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">管理员管理</a>
                <ul class="dropdown-content">
                    <li><a href="manager_current.php">管理员现状</a></li>
                    <li><a href="add_manager.php">管理员添加</a></li>
                    <li><a href="modify_manager.php">管理员修改</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">设备管理</a>
                <ul class="dropdown-content">
                    <li><a href="computer_usage.php">设备使用情况</a></li>
                    <li><a href="computer_repair.php">设备维修</a></li>
                    <li><a href="computer_add.php">设备添加</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- 右侧内容区域 -->
    <div class="content">
        <h2>当前需要维修的设备</h2>
        <br>
            <?php
            include_once "../backend/conn.php";
            $sql = "SELECT * FROM computer_information WHERE status = 2 order by computer_id ASC";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0)
            {
                echo "<table>
                        <thead>
                <tr>
                    <th>电脑状态</th>
                    <th>电脑编号</th>
                    <th>是否维修</th>
                </tr>
                </thead>";
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                    echo"<td><div class='status_maintenance'>损坏</div></td>";
                    echo "<td>".$row['computer_id']."</td>";
                    echo "<td>";
                    echo "<form action='../backend/computer_repair.php' method='post'> 
                    <input type='hidden' name='computer_id'  value='{$row['computer_id']}'>'
                    <button type='submit'>维修</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else
            {
                echo "当前没有设备需要维修";
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
    setInterval(updateTime, 1000);
    updateTime(); // 初始化时间
</script>
</body>
</html>
