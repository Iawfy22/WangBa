<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>新用户注册</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
<div class="container">
    <div class="form-box">
        <form class="form-register" action="../backend/postReg.php" method="post">
            <h2>注册新用户</h2>
            <div class="form-group">
                <label>用户名：</label>
                <input type="text" name="username" required><span class="red">*</span>
            </div>
            <div class="form-group">
                <label>身份证号：</label>
                <input type="text" name="id" required><span class="red">*</span>
            </div>
            <div class="form-group">
                <label>性别：</label>
                <input name="user_sex" type="radio" checked value="1">男
                <input name="user_sex" type="radio" value="0">女
            </div>
            <div class="form-group">
                <label>密码：</label>
                <input type="password" name="password" required><span class="red">*</span>
            </div>
            <div class="form-group">
                <label>确认密码：</label>
                <input type="password" name="password2" required><span class="red">*</span>
            </div>
            <div class="form-group">
                <label>充值金额：</label>
                <input type="text" name="money" required><span class="red">*</span>
            </div>

            <div class="form-group">
                <button type="submit">确定</button>
            </div>
            <div class="form-group">
                <button type="reset">重置</button>
            </div>
        </form>
    </div>
</div>
<!--<script>-->
<!--    function  check()-->
<!--    {-->
<!--        let pw = document.getElementsByName("password")[0].value.trim();-->
<!--        let pw2 = document.getElementsByName("password2")[0].value.trim();-->
<!--        let id = document.getElementsByName("id")[0].value.trim()-->
<!---->
<!--        alert(pw);-->
<!--        return false;-->
<!--        let pwreg = /^[a-zA-Z0-9]{6,20}$/-->
<!--        if(!pwreg.test(pw))  // 密码内容判断-->
<!--        {-->
<!--            alert('密码只能是大小写字母和数字，长度为6--20！');-->
<!--            return false;-->
<!--        }-->
<!--        if (pw != pw2)-->
<!--        {-->
<!--            alert('两次密码输入不一致！');-->
<!--            return false;-->
<!--        }-->
<!---->
<!--        let idreg = /^[1-9]\d{5}(18|19|20)\d{2}((0[1-9])|(1[0-2]))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/;-->
<!--        if(!idreg.test(id))-->
<!--        {-->
<!--            alert('身份证号码输入不正确！');-->
<!--            return false;-->
<!--        }-->
<!---->
<!--        return true;-->
<!---->
<!--    }-->
<!--</script>-->
</body>
</html>
