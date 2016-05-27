<?php

/**
 * Created by PhpStorm.
 * User: hanchao
 * Date: 2016/5/25
 * Time: 18:24
 */
require_once ("class/TableAdminForUsers.class.php");
class LoginVerification
{
    function login($userId,$password,$type){
        $tableUsers=new TableAdminForUsers();
        if ($type=="user")
            $result=$tableUsers->search($userId,"");
        elseif ($type=="admin"){
            if ($userId=="10000")
                $result=$tableUsers->search($userId,"");
            else 
                return "The admin doesn't exist !";
        } else
            return "The user type doesn't exist !";
        if ($result->num_rows==1){
            $row = mysqli_fetch_array($result);
            if ($row["Password"]==$password)
                return $type;
            else
                return "The password is wrong !";
        }
        return "The user doesn't exist !";
    }
}