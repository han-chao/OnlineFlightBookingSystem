<?php session_start();
    $_SESSION["userID"]="";
require_once ("class/LoginVerification.class.php");
    $result="";
    if (isset($_POST["userId"])&&isset($_POST["password"])&&isset($_POST["type"])){
        $login=new LoginVerification();
        $result= $login->login($_POST["userId"],$_POST["password"],$_POST["type"]);
        if ($result=="user" || $result=="admin" ){
            $_SESSION["userID"]=$_POST["userId"];
                if ($result=="user"){
                    Header('Refresh: 0; url=index.php');
                    exit();
                }
                if ($result=="admin"){
                    Header('Refresh: 0; url=admin.php');
                    exit();
                }

        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <script src="js/data.js"></script>
    <!-- Custom Theme files -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<!-- header-starts -->
<div class="header">
    <div class="container">
        <div class="header-info">
            <h4 style="color: red"><?php echo $result?></h4>
            <div class="header-info-head text-center">
                <form method="post" action="login.php">
                <table class="row">
                    <tr><td><input class="form-control" type="text" id="userId" name="userId" placeholder="用户ID"></td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td><input type="password" class="form-control" id="password" name="password" placeholder="密码"></td></tr>
                    <tr><td style="color: white"><input type="radio"  name="type" value="user" checked>乘客 <input type="radio"  name="type" value="admin">管理员</td></tr>
                    <tr><td><input name="button" type="submit" class="btn" onClick="return login();" value="登录"> <a href="index.php" class="btn">首页</a></td></tr>
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