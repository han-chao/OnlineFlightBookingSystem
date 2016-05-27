<?php

/**
 * Created by PhpStorm.
 * User: hanchao
 * Date: 2016/5/25
 * Time: 21:42
 */
class TableAdminForFlight
{
    private $conn;
    //构造函数
    function __construct(){
        $xml=simplexml_load_file("config.xml");
        // 创建连接
        $this->conn =mysqli_connect($xml->serverName, $xml->userName, $xml->password, $xml->dbName);
        // 检测连接
        if (! $this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    //析构函数
    function __destruct(){
        mysqli_close($this->conn);
    }
    //根据航班号查询航班信息
    function search($flight,$start,$terminus ,$startTime){
        if ($flight!=""){
            return mysqli_query($this->conn,"SELECT * FROM flight WHERE Flight='".$flight."'");
        }else{
            return mysqli_query($this->conn,"SELECT * FROM flight WHERE Start='".$start."' AND Terminus='".$terminus."' AND Start_time > '".$startTime."'");
        }
    }
    //售票或者退票后  ，改变乘客数量、座位余量
    function update($flight,$passenger_num,$remain){
        mysqli_query($this->conn,"UPDATE flight SET Remain= '".$remain."',Passenger_num='".$passenger_num."' WHERE Flight='".$flight."'");
    }
    //获取所有目的地
    function getAllStartCity(){
        return  mysqli_query($this->conn,"SELECT Start FROM flight");
    }
    //获取所有目的地
    function getAllTerminusCity(){
        return mysqli_query($this->conn,"SELECT Terminus FROM flight");
    }
    function getAllInfo(){
        return mysqli_query($this->conn,"SELECT * FROM flight");
    }
    //添加航班
    function insert($Flight,$Start,$Terminus,$Start_time,$End_time,$Company,$Flight_type,$Passenger_num,$Remain,$Status,$Price){
        $sql ="INSERT INTO flight (Flight,Start,Terminus,Start_time,End_time,Company,Flight_type,Passenger_num,Remain,Status,Price)
VALUES ('".$Flight."','".$Start."','".$Terminus."','".$Start_time."','".$End_time."','".$Company."','".$Flight_type."','".$Passenger_num."','".$Remain."','".$Status."','".$Price."');";
        if (mysqli_query($this->conn, $sql)){
            return true;
        }
        return false;
    }
    //删除航班
    function deleted($Flight){
       return mysqli_query($this->conn,"DELETE FROM flight WHERE Flight='".$Flight."';");
    }
    function updateAll($Flight,$Start,$Terminus,$Start_time,$End_time,$Company,$Flight_type,$Status,$Price){
        $sql="UPDATE flight SET Start='".$Start."',Terminus='".$Terminus."',Start_time='".$Start_time."',End_time='".$End_time."'
        ,Company='".$Company."',Flight_type='".$Flight_type."',Status='".$Status."',Price='".$Price."'WHERE Flight='".$Flight."';";
        return mysqli_query($this->conn,$sql);
    }
}