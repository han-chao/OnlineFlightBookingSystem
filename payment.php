<?php session_start();
require_once ("class/TicketAdmin.class.php");
$ticketAdmin=new TicketAdmin();
if (isset($_SESSION["userID"]) ){
    if (isset($_POST["ticketNum"]) &&isset($_GET['flight'])){
        if($_SESSION["userID"]!="")
            $ticketAdmin->bookingTicket($_SESSION["userID"],$_GET['flight'],$_POST["ticketNum"]);
        else{
            echo "<script>alert('请先登录')</script>";
        }
    }
}else{
    echo "<script>alert('请先登录')</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Payment</title>
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
                <script type="text/javascript" src="js/nav.js"></script>
            </div>
            <!-- end h_menu4 -->
        </div>
    </div>
</div>
<!-- header-ends -->
<!-- content-section-starts -->
    <div class="container">
        <div class="paymemt-row-wrap">
            <div class="col-md-6">
                <div class="booking-item-payment">
                    <ul class="booking-item-payment-details" style="font-size: 20px">
                        <?php
                        if(isset($_GET["flight"])){
                            require_once ("class/FlightAdmin.class.php");
                            (new FlightAdmin())->searchFlight($_GET["flight"],'','','');
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 ">
                <input id="flight" placeholder="按航班号查找">&nbsp;<a id="a_href"><input type="button" onclick="return search();" class="btn" value="查找"></a>
<br/><br/><br/><br/>
                <?php
                //显示预定表单
                if (isset($_GET['flight'])){
                    echo "<form method='post' action='payment.php?flight=".$_GET['flight']."'>";
                    echo "<label for='ticketNum' >购票数量</label>";
                    echo "<select id='ticketNum' name='ticketNum'>";
                    for ($n=1;$n<10;$n++){
                        echo "<option value='".$n."'>".$n."</option>";
                    }
                    echo "</select>";
                    echo "<input type=\"submit\" class=\"btn\" value=\"提交\">";
                    echo "</form>";
                }
                ?>
            </div>
        </div>

    </div>
    <!-- content-section-ends -->
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <!-- footer-section-starts -->
    <div class="footer">
        <div class="copy-rights text-center">
            <p>Copyright &copy; 2016.BJUT-SSE-Team9 All rights reserved.</p>
        </div>
    </div>
    <!-- footer-section-ends -->
</body>
</html>