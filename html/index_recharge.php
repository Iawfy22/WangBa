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
        <form class="form-login" action="../backend/index_recharge.php" , method="post">
            <h2>用户充值</h2>
            <div class="form-group">
                <label>用户名：</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>充值金额：</label>
                <input type="password" name="recharge_money" required>
            </div>
            <div class="form-group">
                <button type="submit">确认</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
