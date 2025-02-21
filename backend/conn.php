<?php

// 连接数据库
// 连接数据库服务器
$conn = mysqli_connect("localhost","root","zyf20040223", "database_course");

if(!$conn)  // 数据库连接不成功
{
    die("数据库连接失败");
}

// 设置字符集
mysqli_query($conn, "SET NAMES utf8");
