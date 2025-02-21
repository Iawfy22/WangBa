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
        <form class="form-login" action="../backend/postManagerLogin.php" , method="post">
            <h2>管理员登录</h2>
            <div class="form-group">
                <label for="login-username">管理员名：</label>
                <input type="text" name="manager_name" required>
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
        </form>
    </div>
</div>
</body>
</html>
