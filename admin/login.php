<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Sign in &laquo; Admin</title>
    <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/assets/css/admin.css">
</head>

<body>
    <div class="login">
        <form class="login-wrap">
            <img class="avatar" src="../static/assets/img/default.png">
            <!-- 有错误信息时展示 -->
            <div class="alert alert-danger">
                <strong>错误！</strong><span id="msg">邮箱格式不正确，请重试</span>
            </div>
            <div class="form-group">
                <label for="email" class="sr-only">邮箱</label>
                <input id="email" type="email" class="form-control" placeholder="邮箱" autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">密码</label>
                <input id="password" type="password" class="form-control" placeholder="密码">
            </div>
            <span class="btn btn-primary btn-block" id="btn">登 录</span>
        </form>
    </div>
    <script src="../static/assets/vendors/jquery/jquery.min.js"></script>
    <script>
        $(function(){
            $(".alert").hide()
            $('#btn').on('click',function(){
                var email=$('#email').val()
                var pwd=$('#password').val()
                var reg=/^\w+[@]\w+[.]\w+$/
                if(!reg.test(email)){
                    $('.alert').fadeIn(500).children('#msg').text('邮箱格式不正确，请重试')
                    return
                }
                $.ajax({
                    type:'post',
                    url:'../api/usersLogin.php',
                    data:{
                        "email":email,
                        "password":pwd
                    },
                    dataType:'json',
                    success:function(res){
                        if(res.code==1){
                            location.href="./index.php"
                        }else{
                            $('.alert').fadeIn(500).children('#msg').text('用户名密码不正确')
                        }
                        
                    }
                })
            })
        })
    </script>
</body>

</html>