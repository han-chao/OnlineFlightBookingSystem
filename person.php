<?php session_start();
require_once ("class/PassengerInfoAdmin.class.php");
require_once ("class/TicketAdmin.class.php");
$ticketAdmin=new TicketAdmin();
$passenger=new PassengerInfoAdmin();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Person</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="js/data.js"></script>
</head>
<body>
<!-- header-starts -->
<div class="page-header">
    <div class="container">
        <div class="page-header-info">
            <div class="h_menu4">
                <a class="toggleMenu" href="">Menu</a>
                <ul class="nav p-nav">
                    <li class="active"><a href="index.php">主页</a></li>
                    <li  class="active"><a href="person.php">个人</a>
                    <li  class="active"><a href="payment.php">预定</a></li>
                    <li  class="active"><a href="search.php">查询</a></li>
                    <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                    <?php
                    if(isset($_SESSION["userID"]) && $_SESSION["userID"]!="") {
                        echo "<li  class=\"active\"><a href=\"login.php\">注销</a></li>";
                    }else{
                        echo "<li  class=\"active\"><a href=\"login.php\">登录</a></li>";
                        echo "<li  class=\"active\"><a href=\"register.php\">注册</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- end h_menu4 -->
        </div>
    </div>
</div>
<!-- header-ends -->
<!-- content-section-starts -->
<div class="main_bg">
    <div class="container">
<!--        左侧菜单-->
        <div class="sidebar">
            <ul class="s_nav"><li><h2>个人信息管理</h2></li>
                <li>
                   <a href="person.php?action=info"><input name="button2" type="button" class="btn"  style="width: 150px;" value="基本信息"></a>
                </li>
            </ul>
            <p>&nbsp;</p>
            <ul class="s_nav">
                <li>
                    <a href="person.php?action=changePwd"><input type="button" class="btn" value="修改密码"  style="width: 150px;"  ></a>
                </li>
            </ul>
            <p>&nbsp;</p>
            <ul class="s_nav">
                <li>
                    <a href="person.php?action=order"><input type="button" class="btn" value="订单管理"  style="width: 150px;"></a>
                </li>
                <li></li>
            </ul>
        </div><br/>
        <!--右侧显示信息页 -->
        <div class="row">
<!--            <div class="container">-->
                <?php
                if(isset($_GET["action"])){
                    if (isset($_SESSION["userID"])&&$_SESSION["userID"]!=""){
                        if ($_GET["action"]=="info"){ //显示个人信息
                            $passenger->getPassengerInfo($_SESSION["userID"]);
                        }                        
                        if ($_GET["action"]=="updateInfo"&& isset($_POST["userName"])&& isset($_POST["certificate"])&& isset($_POST["phone"])){ //更新个人信息
                            $passenger->updatePassengerInfo($_SESSION["userID"],$_POST["userName"],$_POST["certificate"],$_POST["phone"]);
                            Header('Refresh: 0; url=person.php?action=info');
                            exit();
                        }
                        if ($_GET["action"]=="changePwd"){   //显示修改密码界面
                            $passenger->displayChangePwdInterface();
                        }                           
                        if ($_GET["action"]=="doChangePwd" &&isset($_POST["oldPwd"])&& isset($_POST["newPwd"])){   //修改密码
                            $passenger->changePassword($_SESSION["userID"],$_POST['oldPwd'],$_POST['newPwd']);
                        }
                        if ($_GET["action"]=="order"){   //显示订单
                            $ticketAdmin->OrderManagement($_SESSION["userID"]);
                        }
                        if ($_GET["action"]=="refund" &&isset($_GET["flight"])&&isset($_GET["sit"])){ //退票
                            $ticketAdmin->refundTicket($_GET["flight"],$_GET["sit"]);
                            Header('Refresh: 0; url=person.php?action=order');
                            exit();
                        }
                    }else{
                        echo "<script>alert('请先登录');</script>";
                        Header('Refresh: 0; url=login.php');
                        exit();
                    }
                }
                ?>
<!--            </div>-->
        </div>
    </div>
</div>

<br/><br/><br/><br/><br/><br/><br/><br/>
<div class="footer">
    <div class="copy-rights text-center">
        <p>Copyright &copy; 2016.BJUT_SSE_Team9 All rights reserved. <a href="http://www.cssmoban.com/" target="_blank" ></a></p>
    </div>
</div>
<!-- footer-section-ends -->
</body>
</html>