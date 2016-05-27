<?php

/**
 * Created by PhpStorm.
 * User: hanchao
 * Date: 2016/5/25
 * Time: 22:25
 */
class TableAdminForTicket
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
    //添加机票
    function insert($Flight,$Name,$Start_time,$End_time,$Start,$Terminus,$Company,$Price,$Flight_type,$Sit){
        $sql ="INSERT INTO ticket (Flight,Name,Start_time,End_time,Start,Terminus,Company,Price,Flight_type,Sit)
VALUES ('".$Flight."', '".$Name."', '".$Start_time."', '".$End_time."', '".$Start."', '".$Terminus."', '".$Company."', '".$Price."', '".$Flight_type."', '".$Sit."');";
        mysqli_query($this->conn,$sql);
    }
    //删除机票
    function  delete($flight,$sit){
        mysqli_query($this->conn,"DELETE FROM ticket WHERE Flight='".$flight."'AND Sit='".$sit."'");
    }
    //查询
    function search ($name){
      return  mysqli_query($this->conn,"SELECT * FROM ticket WHERE Name='".$name."'");
    }
}