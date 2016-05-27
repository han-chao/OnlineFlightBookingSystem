<?php

/**
 * Created by PhpStorm.
 * User: hanchao
 * Date: 2016/5/25
 * Time: 23:23
 */
require_once ('class/TableAdminForFlight.class.php');
class FlightAdmin
{
    private $tableFlight;
    //构造函数
    function __construct(){
        $this->tableFlight=new TableAdminForFlight();
    }
    //获取所有出发地
    function getAllStartCity(){
        $result = $this->tableFlight->getAllStartCity();
        while ( $row = mysqli_fetch_array($result)){
            echo "<option value='".$row["Start"]."'>".$row["Start"]."</option>";
        }
    }
    //获取所有目的地
    function getAllTerminusCity(){
        $result = $this->tableFlight->getAllTerminusCity();
        while ( $row = mysqli_fetch_array($result)){
            echo "<option value='".$row["Terminus"]."'>".$row["Terminus"]."</option>";
        }
    }
    //查询航班信息
    function searchFlight($flight,$start,$terminus ,$startTime){
        $result =  $this->tableFlight->search($flight,$start,$terminus ,$startTime);
        if ($flight==""){
            while ( $row = mysqli_fetch_array($result)){
                echo "<tr><td>".$row["Flight"]."</td>";
                echo "<td>".$row["Start"]."</td>";
                echo "<td>".$row["Terminus"]."</td>";
                echo "<td>".$row["Start_time"]."</td>";
                echo "<td>".$row["End_time"]."</td>";
                echo "<td>".$row["Remain"]."</td>";
                echo "<td><a href='payment.php?flight=".$row["Flight"]."'><input type='button' value='预定'></a></td></tr>";
            }
        }else{
            while ( $row = mysqli_fetch_array($result)){
                echo "<li><h1>".$row["Start"].">>>>>".$row["Terminus"]."</h1></li>";
                echo "<li>"."航 班 号：".$row["Flight"]."</li>";
                echo "<li>"."出发时间：".$row["Start_time"]."</li>";
                echo "<li>"."到达时间：".$row["End_time"]."</li>";
                echo "<li>"."航空公司：".$row["Company"]."</li>";
                echo "<li>"."座位余量：".$row["Remain"]."</li>";
            }
        }
    }
    function getAllFlightInfo(){
        $result=$this->tableFlight->getAllInfo();
        if ($result->num_rows >0){
            echo " <table class='table table-hover table-condensed'>";
            echo "<header><h2 align='center'>航班信息</h2></header>";
            echo "<tr><td>航班号</td><td>始发机场</td><td>目的机场</td><td>出发时间</td><td>到达时间</td><td>航空公司</td><td>飞机类型</td><td>乘客数量</td><td>座位余量</td><td>当前状态</td><td>机票价格</td><td/><td/></tr>";
            while ($row = mysqli_fetch_array($result)){
                echo "<tr><td>".$row["Flight"]."</td>";
                echo "<td>".$row["Start"]."</td>";
                echo "<td>".$row["Terminus"]."</td>";
                echo "<td>".$row["Start_time"]."</td>";
                echo "<td>".$row["End_time"]."</td>";
                echo "<td>".$row["Company"]."</td>";
                echo "<td>".$row["Flight_type"]."</td>";
                echo "<td>".$row["Passenger_num"]."</td>";
                echo "<td>".$row["Remain"]."</td>";
                echo "<td>".$row["Status"]."</td>";
                echo "<td>".$row["Price"]."</td>";
                echo "<td><a href='admin.php?action=deleteFlight&&flight=".$row["Flight"]."'><input type='button' class=\"btn\" value='删除'></a></td>";
                echo "<td><a href='admin.php?action=changeFlight&&flight=".$row["Flight"]."'><input type='button' class=\"btn\" value='修改'></a></td></tr>";
            }
            echo "</table>";
        }

    }
    //显示添加航班界面
    function displayAddFlightInterface(){
        echo "<form action='admin.php?action=doAddFlight' method='post'>";
        echo " <table width='auto'  align=\"center\" style='font-size: 30px'>";
        echo "<header><h2 align='center'>添加航班</h2></header>";
        echo "<tr><td><input name='Flight' id='Flight' class=\"form-control\" placeholder='输入航班号'></td></tr>";
        echo "<tr><td><input name='Start'id='Start' class=\"form-control\" placeholder='输入始发机场'></td></tr>";
        echo "<tr><td><input name='Terminus'id='Terminus' class=\"form-control\" placeholder='输入目的机场'></td></tr>";
        echo "<tr><td><input name='Start_time'id='Start_time' class=\"form-control\" placeholder='输入出发时间'></td></tr>";
        echo "<tr><td><input name='End_time' id='End_time' class=\"form-control\" placeholder='输入到达时间'></td></tr>";
        echo "<tr><td><input name='Company' id='Company' class=\"form-control\" placeholder='输入航空公司'></td></tr>";
        echo "<tr><td><input name='Flight_type' id='Flight_type' class=\"form-control\" placeholder='输入飞机类型'></td></tr>";
        echo "<tr><td><input name='Remain' id='Remain' class=\"form-control\" placeholder='输入座位余量'></td></tr>";
        echo "<tr><td><input name='Status' id='Status' class=\"form-control\" placeholder='输入当前状态'></td></tr>";
        echo "<tr><td><input name='Price' id='Price' class=\"form-control\" placeholder='输入机票价格'></td></tr>";
        echo  "<td><input type='submit'class='btn'value='确认' onclick='return flightInfoIsEmpty();'></td></tr>";
        echo " </table></form>";
    }
    //添加航班
    function AddFlight($Flight,$Start,$Terminus,$Start_time,$End_time,$Company,$Flight_type,$Remain,$Status,$Price){
       $result= $this->tableFlight->search($Flight,"",'','');
        if($result->num_rows >0){
            echo "<script>alert('添加航班失败！航班：".$Flight."已经存在！');</script>";
        }else{ //插入数据到表
            $result= $this->tableFlight->insert($Flight,$Start,$Terminus,$Start_time,$End_time,$Company,$Flight_type,0,$Remain,$Status,$Price);
            if($result==true){
                echo "<script>alert('添加航班成功！');</script>";
            } else{
                echo "<script>alert('添加航班失败！');</script>";
            }
        }
        header('Refresh: 0; url=admin.php?action=addFlight');
        exit();
    }
    //显示删除航班界面
    function displayDeleteFlightInterface(){
        
//        <input id="flight" placeholder="输入要删除的航班号">&nbsp;<a id="a_href"><input type="button" onclick="return search();" class="btn" value="查找"></a>

    }
    //删除航班
    function deleteFlight($Flight){
        $result= $this->tableFlight->deleted($Flight);
        if($result== true){
            echo "<script>alert('删除航班".$Flight."成功！');</script>";
        }
        if($result== false){
            echo "<script>alert('删除航班".$Flight."失败！');</script>";
        }
        header('Refresh: 0; url=admin.php?action=flightInfo');
        exit();
    }

    //显示修改航班界面
    function displayChangeFlightInterface($Flight){
        $result =  $this->tableFlight->search($Flight,'','' ,'');
        if($result->num_rows ==1){
            $row = mysqli_fetch_array($result);
            echo "<form action='admin.php?action=doChangeFlight' method='post'>";
            echo " <table width='auto'  align=\"center\" style='font-size: 30px'>";
            echo "<header><h2 align='center'>修改航班信息</h2></header>";
            echo "<tr><td>航 班 号:</td><td><input name='Flight'class='form-control'readonly value='".$row["Flight"]."' ></td></tr>";
            echo "<tr><td>始发机场:</td><td><input name='Start'id='Start' class='form-control' value='".$row["Start"]."' ></td></tr>";
            echo "<tr><td>目的机场:</td><td><input name='Terminus'id='Terminus' class='form-control' value='".$row["Terminus"]."' ></td></tr>";
            echo "<tr><td>出发时间:</td><td><input name='Start_time'id='Start_time' class='form-control' value='".$row["Start_time"]."' ></td></tr>";
            echo "<tr><td>到达时间:</td><td><input name='End_time' id='End_time' class='form-control' value='".$row["End_time"]."' ></td></tr>";
            echo "<tr><td>航空公司:</td><td><input name='Company' id='Company' class='form-control' value='".$row["Company"]."' ></td></tr>";
            echo "<tr><td>飞机类型:</td><td><input name='Flight_type' id='Flight_type' class='form-control' value='".$row["Flight_type"]."' ></td></tr>";
            echo "<tr><td>旅客数量:</td><td><input name='Passenger_num'  class='form-control' readonly value='".$row["Remain"]."' ></td></tr>";
            echo "<tr><td>座位余量:</td><td><input name='Remain' class='form-control' readonly value='".$row["Remain"]."' ></td></tr>";
            echo "<tr><td>当前状态:</td><td><input name='Status' id='Status' class='form-control' value='".$row["Status"]."' ></td></tr>";
            echo "<tr><td>机票价格:</td><td><input name='Price' id='Price' class='form-control' value='".$row["Price"]."' ></td></tr>";
            echo  "<td><input type='submit'class='btn'value='确认' onclick='return flightInfoIsEmpty();'></td></tr>";
            echo " </table></form>";
        }
    }
    function changeFlight($Flight,$Start,$Terminus,$Start_time,$End_time,$Company,$Flight_type,$Status,$Price){
        $result =  $this->tableFlight->updateAll($Flight,$Start,$Terminus,$Start_time,$End_time,$Company,$Flight_type,$Status,$Price);
        if($result== true){
            echo "<script>alert('修改航班".$Flight."成功！');</script>";
        }
        if($result== false){
            echo "<script>alert('修改航班".$Flight."失败！');</script>";
        }
        header('Refresh: 0; url=admin.php?action=flightInfo');
        exit();
    }
}