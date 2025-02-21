<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>网吧管理系统</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<div class="container">
    <div class="form-box">
        <form class="form-login" action="../backend/postUserLogin.php" , method="post">
            <h2>用户登录</h2>
            <div class="form-group">
                <label for="login-username">用户名：</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label for="login-password">密码：</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="reset">重置</button>
            </div>
            <div class="form-group">
                <button type="submit">登录</button>
            </div>
            <div class="form-group">
                <a href="forgetpw.php">忘记密码?</a> | <a href="./registered.php">新用户注册</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>