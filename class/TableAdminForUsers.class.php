<?php

/**
 * Created by PhpStorm.
 * User: hanchao
 * Date: 2016/5/25
 * Time: 18:27
 */
class TableAdminForUsers
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
    //查找表users
    // 成功返回id 否则返回null
    function search($userId,$password){
        if ($password !="")
            return mysqli_query($this->conn,"SELECT * FROM users WHERE Id='".$userId."'AND Password='".$password."' ");
        else
            return mysqli_query($this->conn,"SELECT * FROM users WHERE Id='".$userId."'");
    }
    function insert($username,$password){
        $sql ="INSERT INTO users (UserName,Password)
VALUES ('".$username."', '".$password."');";
        if (mysqli_query($this->conn, $sql)) {
                return mysqli_insert_id($this->conn);
        }
        return null;
    }
    //更新 users信息
    function update($userId,$userName,$password){
        if ($password==""){
            mysqli_query($this->conn,"UPDATE users SET UserName='".$userName."' WHERE Id='".$userId."';");
        }else{
            mysqli_query($this->conn,"UPDATE users SET Password='".$password."' WHERE Id='".$userId."';");
        }
            
    }
}