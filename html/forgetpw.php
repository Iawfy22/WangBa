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
        <form class="form-login" action="../backend/forgetpw.php" , method="post">
            <h2>密码找回</h2>
            <div class="form-group">
                <label for="login-username">用户名：</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label for="login-password">身份证号：</label>
                <input type="text" name="id" required>
            </div>
            <div class="form-group">
                <button type="reset">重置</button>
            </div>
            <div class="form-group">
                <button type="submit">确认</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
