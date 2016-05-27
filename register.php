<?php
    if(isset($_POST["username"])&&isset($_POST["password"])&&isset($_POST["certificate"])&&isset($_POST["phone"])){
        require_once ("class/PassengerInfoAdmin.class.php");
        $db=new PassengerInfoAdmin();
        $db->register($_POST["username"],$_POST["password"],$_POST["certificate"],$_POST["phone"]);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>注册</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <script src="js/data.js"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<!-- header-starts -->
<div class="header">
    <div class="container">
        <div class="header-info">
            <div class="header-info-head text-center">
                <form method="post" action="register.php">
                    <table class="row">
                        <tr><td><input class="form-control" type="text" id="username" name="username" placeholder="用户名"></td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td><input type="password" class="form-control" id="password" name="password" placeholder="密码"></td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td><input class="form-control" type="text" id="certificate" name="certificate" placeholder="证件号"></td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td><input class="form-control" type="text" id="phone" name="phone" placeholder="电话号"></td></tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr><td><input name="button" type="submit" class="btn" onClick=" return register();" value="注册"> <a href="index.php" class="btn">首页</a></td></tr>
                    </table>
                </form>
                <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            </div>

        </div>
    </div>
</div>
<!-- header-ends -->
<!-- footer-section-starts -->
<div class="footer">
    <div class="copy-rights text-center">
        <p>Copyright &copy; 2016.BJUT_SSE_Team9 All rights reserved.</p>
    </div>
</div>
<!-- footer-section-ends -->
</body>
</html>