<?php session_start();
require_once ("class/FlightAdmin.class.php");
require_once ("class/PassengerInfoAdmin.class.php");
$flightAdmin=new FlightAdmin();
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>后台管理</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="js/data.js"></script>
</head>
<body>
<!-- header-starts -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 ">
                <h1 style="color: white">在线订票系统后台管理</h1>
            </div>
            <div class="col-md-2">
                <?php
                if(isset($_SESSION["userID"]) && $_SESSION["userID"]!="") {
                    echo "<br><a href=\"login.php\"><button class='btn'>注销</button></a>";
                }else{
                    echo "<br><a href=\"login.php\"><button class='btn'>登录</button></a>";
                }
                ?>
            </div>
        </div>
            <!-- end h_menu4 -->
    </div>
</div>
<!-- header-ends -->
<!-- content-section-starts -->
<div class="main_bg">
    <div class="container">
        <!-- 左侧菜单-->
        <div class="row">
            <div class="col-md-2 ">
                    <ul class="s_nav">
                        <li>
                            <a href="admin.php?action=adminInfo"><input type="button" class="btn" value="个人信息"  style="width: 100px;"  ></a>
                        </li>
                    </ul>
                    <ul class="s_nav">
                        <li>
                            <a href="admin.php?action=flightInfo"><input type="button" class="btn" value="航班信息"  style="width: 100px;"  ></a>
                        </li>
                    </ul>
                    <ul class="s_nav">
                        <li>
                            <a href="admin.php?action=addFlight"><input type="button" class="btn"  style="width: 100px;" value="添加航班"></a>
                        </li>
                    </ul>
            </div>
        <!--右侧显示信息页 -->
            <div class="col-md-10  ">
<!--        <div class="row">-->
            <!--            <div class="container">-->
            <?php
            if(isset($_GET["action"])){
                if (isset($_SESSION["userID"]) && $_SESSION["userID"]!=""){
                    if($_GET["action"]=="adminInfo"){    //显示管理员的个人信息
                        (new PassengerInfoAdmin())->getAdminInfo($_SESSION["userID"]);
                    }
                    if($_GET["action"]=="flightInfo"){    //显示所有航班信息
                        $flightAdmin->getAllFlightInfo();
                    }
                    if($_GET["action"]=="addFlight"){    //显示添加航班界面
                        $flightAdmin->displayAddFlightInterface();
                    }
                    if($_GET["action"]=="doAddFlight"&& isset($_POST["Flight"])){//添加航班
                       $flightAdmin->AddFlight($_POST["Flight"],$_POST["Start"],$_POST["Terminus"],$_POST["Start_time"],$_POST["End_time"],$_POST["Company"]
                                                     ,$_POST["Flight_type"],$_POST["Remain"],$_POST["Status"],$_POST["Price"]);
                    }
                    if($_GET["action"]=="deleteFlight"&& $_GET["flight"]){//删除航班
                        $flightAdmin->deleteFlight($_GET["flight"]);
                    }
                    if($_GET["action"]=="changeFlight" && $_GET["flight"]){//显示更改航班界面
                        $flightAdmin->displayChangeFlightInterface( $_GET["flight"]);
                    }
                    if($_GET["action"]=="doChangeFlight"&& isset($_POST["Flight"])) {//添加航班
                      $flightAdmin->changeFlight($_POST["Flight"], $_POST["Start"], $_POST["Terminus"], $_POST["Start_time"], $_POST["End_time"], $_POST["Company"]
                            , $_POST["Flight_type"], $_POST["Status"], $_POST["Price"]);
                    }
                }else{
                    echo "<script>alert('请先登录');</script>";
                    Header('Refresh: 0; url=login.php');
                    exit();
                }
            }
            ?>
        </div>
    </div>
</div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div class="footer">
    <div class="copy-rights text-center">
        <p>Copyright &copy; 2016.BJUT_SSE_Team9 All rights reserved.</a></p>
    </div>
</div>
<!-- footer-section-ends -->
</body>
</html>