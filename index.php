<?php session_start();
require_once ("class/FlightAdmin.class.php");
$flightAdmin=new FlightAdmin();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>航班在线预定系统</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="css/tcal.css" />
    <script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="js/tcal.js"></script>
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
<div class="content-section">
    <div class="container">
        <h3 class="page-title">搜索航班</h3>
        <form method="post" action="search.php">
            <div class="reservation">
            <ul>
                <li class="span1_of_1">
                    <h5>出发</h5>
                    <!----------start section_room----------->
                    <div class="section_room">
                        <select id="startCity" name="startCity" class="frm-field required" >
                            <?php $flightAdmin->getAllStartCity();?>
                        </select>
                    </div>
                </li>
                <li class="span1_of_1">
                    <h5>到达</h5>
                    <!----------start section_room----------->
                    <div class="section_room">
                        <select id="terminusCity" name="terminusCity" class="frm-field required">
                            <?php $flightAdmin->getAllTerminusCity();?>
                        </select>
                    </div>
                </li>
                <li  class="span1_of_1 left">
                    <h5>出发时间</h5>
                    <div class="book_date">
                            <input class="tcal" id="datePicker" name="startTime"  type="text">
                    </div>
                </li>
                <li >
                    <h5>&nbsp;</h5>
                    <div>
                        <input type="submit" class="btn" onClick="return modify();" value="搜索">
                    </div>
                </li>
            </ul>
        </div>
        </form>
    </div>

    <div class="container">
        <div class="gap gap-small"></div>
        <h3 class="mb20">热门目的地</h3>
        <div class="row row-wrap">
            <div class="col-md-3 thumb">
                <a class="hover-img" href="#">
                    <img src="images/1.jpg" alt="Image Alternative text" title="Gaviota en el Top" />
                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                        <div class="text-small">
                            <h5>巴黎</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 thumb">

                <a class="hover-img" href="#">
                    <img src="images/2.jpg" alt="Image Alternative text" title="Sydney Harbour" />
                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                        <div class="text-small">
                            <h5>悉尼</h5>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-md-3 thumb">

                <a class="hover-img" href="#">
                    <img src="images/3.jpg" alt="Image Alternative text" title="Street" />
                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                        <div class="text-small">
                            <h5>洛杉矶</h5>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-md-3 thumb">

                <a class="hover-img" href="#">
                    <img src="images/4.jpg" alt="Image Alternative text" title="the journey home" />
                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                        <div class="text-small">
                            <h5>西雅图</h5>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-md-3 thumb">

                <a class="hover-img" href="#">
                    <img src="images/5.jpg" alt="Image Alternative text" title="lack of blue depresses me" />
                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                        <div class="text-small">
                            <h5>迈阿密</h5>
                        </div>
                    </div>
                </a>

            </div>



            <div class="col-md-3 thumb">
                <a class="hover-img" href="#">
                    <img src="images/8.jpg" alt="Image Alternative text" title="Upper Lake in New York Central Park" />
                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                        <div class="text-small">
                            <h5>亚特兰大</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 thumb">
                <a class="hover-img" href="#">
                    <img src="images/9.jpg" alt="Image Alternative text" title="Viva Las Vegas" />
                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                        <div class="text-small">
                            <h5>拉斯维加斯</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 thumb">
                <a class="hover-img" href="#">
                    <img src="images/12.jpg" alt="Image Alternative text" title="196_365" />
                    <div class="hover-inner hover-inner-block hover-inner-bottom hover-inner-bg-black hover-hold">
                        <div class="text-small">
                            <h5>纽约</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="gap"></div>
    </div>

</div>
<!-- content-section-ends -->
<!-- footer-section-starts -->
<div class="footer">
    <div class="copy-rights text-center">
        <p>Copyright &copy; 2016.BJUT-SSE-Team9 All rights reserved. </p>
    </div>
</div>
<!-- footer-section-ends -->

</body>
</html>