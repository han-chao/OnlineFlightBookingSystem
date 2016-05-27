<?php

/**
 * Created by PhpStorm.
 * User: hanchao
 * Date: 2016/5/25
 * Time: 21:37
 */
require_once ("class/TableAdminForFlight.class.php");
require_once ("class/TableAdminForTicket.class.php");
require_once ("class/TableAdminForUsers.class.php");
class TicketAdmin
{
    private $tableFlight;
    private $tableTicket;
    private $tableUsers;
    
    //构造函数
    function __construct(){
        $this->tableFlight=new TableAdminForFlight();
        $this->tableTicket= new TableAdminForTicket();
        $this->tableUsers=new TableAdminForUsers();
    }
    // 预定票
    //参数：航班号，购票数量
    function bookingTicket($userId,$flight,$num){
       
        $row = mysqli_fetch_array($this->tableUsers->search($userId,""));
        $username=$row["UserName"]; //用户名
        $result=$this->tableFlight->search($flight,"","","");
        $row = mysqli_fetch_array($result);
        $remain=$row['Remain'];  //当前座位余量
        if($remain<$num){ // 余票不足
            echo "<script>alert('购票失败，余票不足！');</script>";
            return;
        }
        $passenger_num=$row['Passenger_num'];  //当前乘客数
        for ($n=0;$n<$num;$n++){ //创建机票
            $this->tableTicket->insert($row["Flight"],$username,$row["Start_time"],$row["End_time"],$row["Start"],$row["Terminus"],$row["Company"],$row["Price"],$row["Flight_type"],$remain-$n);
        }
        $this->tableFlight->update($flight,$passenger_num+$num,$remain-$num);
        echo "<script>alert('预定成功！共".$num."张');</script>";
    }
    //    退票
    function refundTicket($flight,$sit){
        $this->tableTicket->delete($flight,$sit);
        $result= $this->tableFlight->search($flight,'','','');
        $row = mysqli_fetch_array($result);
        $this->tableFlight->update($flight,$row["Passenger_num"]-1,$row["Remain"]+1);
        echo "<script>alert('退票成功!')</script>";
    }
    // 显示所有用户预定的票
    function OrderManagement($userId){
        $result = $this->tableUsers->search($userId,"");
        if($result->num_rows > 0){
            $row = mysqli_fetch_array($result);
            $result = $this->tableTicket->search($row["UserName"]);
            if($result->num_rows > 0){
                echo " <table width='850px'  align=\"center\" border='1'>";
                echo "<header><h2 align='center'>订票信息</h2></header>";
                echo "<tr><td>航班号</td><td>乘客姓名</td><td>出发时间</td><td>到达时间</td><td>始发机场</td><td>目的机场</td><td>航空公司</td><td>机票价格</td><td>座位号</td><td></td></tr>";
                while ($row = mysqli_fetch_array($result)){
                    echo "<tr><td>".$row["Flight"]."</td>";
                    echo "<td>".$row["Name"]."</td>";
                    echo "<td>".$row["Start_time"]."</td>";
                    echo "<td>".$row["End_time"]."</td>";
                    echo "<td>".$row["Start"]."</td>";
                    echo "<td>".$row["Terminus"]."</td>";
                    echo "<td>".$row["Company"]."</td>";
                    echo "<td>".$row["Price"]."</td>";
                    echo "<td>".$row["Sit"]."</td>";
                    echo "<td><a href='person.php?action=refund&&flight=".$row["Flight"]."&&sit=".$row["Sit"]."'><input type='button' class=\"btn\" value='退票'></a></td></tr>";
                }
                echo " </table>";
            }else{
                echo "<script>alert('暂时还没有订票信息!')</script>";
            }
        }
    }
}