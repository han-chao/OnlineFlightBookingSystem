<?php
/**
 * Created by PhpStorm.
 * User: hanchao
 * Date: 2016/5/25
 * Time: 19:00
 */
require_once ("class/TableAdminForPassengers.class.php");
require_once ("class/TableAdminForUsers.class.php");
class PassengerInfoAdmin
{
    //用户注册
    function register($username,$password,$certificate,$phone){
        $result=(new TableAdminForPassengers())->insert($username,$certificate,$phone);
        if ($result!=null){
            $result=(new TableAdminForUsers())->insert($username,$password);
            if($result!=null){
                echo  "<script>alert('注册成功!您的登录ID为：".$result."')</script>";
                return;
            }
        }
        echo  "<script>alert('注册失败！')</script>";
    }
    //获取管理员信息
    function  getAdminInfo($userId){
        $result=(new TableAdminForPassengers())->search($userId);
        $row = mysqli_fetch_array($result);
        echo " <table width='auto'  align=\"center\" style='font-size: 30px'>";
        echo "<header><h1 align='center'>管理员个人信息</h1></header>";
        echo "<tr><td>用户ID：</td><td>".$row["Id"]."</td></tr>";
        echo "<tr><td>用户名：</td><td>".$row["Name"]."</td></tr>";
        echo "<tr><td>证件号：</td><td>".$row["Certificate"]."</td></tr>";
        echo "<tr><td>电话号：</td><td>".$row["Phone"]."</td></tr>";
        echo " </table>";
    }
    //获取个人信息
    function  getPassengerInfo($userId){
        $result=(new TableAdminForPassengers())->search($userId);
        $row = mysqli_fetch_array($result);
        echo "<form action='person.php?action=updateInfo' method='post'>";
        echo " <table width='auto'  align=\"center\" style='font-size: 30px'>";
        echo "<header><h1 align='center'>个人信息</h1></header>";
        echo "<tr><td>用户ID：</td><td><input readonly name='userId' value='".$row["Id"]."'></td></tr>";
        echo "<tr><td>用户名：</td><td><input readonly name='userName' id='userName' value='".$row["Name"]."'></td></tr>";
        echo "<tr><td>证件号：</td><td><input readonly name='certificate' id='certificate' value='".$row["Certificate"]."'></td></tr>";
        echo "<tr><td>电话号：</td><td><input readonly name='phone' id='phone' value='".$row["Phone"]."'></td></tr>";
        echo "<tr><td><input type='button'class='btn' value='修改' onclick='change();'></td>";
        echo  "<td><input type='submit'class='btn' id='sure' value='确认' onclick='return isEmpty();' disabled='disabled'></td></tr>";
        echo " </table></form>";
    }
    //更新个人信息
    function  updatePassengerInfo($userId,$userName,$certificate,$phone){
        (new TableAdminForPassengers())->update($userId,$userName,$certificate,$phone);
        (new TableAdminForUsers())->update($userId,$userName,"");
    }
    function displayChangePwdInterface(){
        echo "<form action='person.php?action=doChangePwd' method='post'>";
        echo " <table width='auto'  align=\"center\" style='font-size: 30px'>";
        echo "<header><h1 align='center'>修改密码</h1></header>";
        echo "<tr><td><input type='password' name='oldPwd'id='oldPwd' class=\"form-control\" placeholder='输入原密码'></td></tr>";
        echo "<tr><td><input  type='password' name='newPwd' id='newPwd' class=\"form-control\" placeholder='输入新密码'></td></tr>";
        echo "<tr><td><input type='password' id='againPwd'class=\"form-control\" placeholder='确认新密码'></td></tr>";
        echo  "<td><input type='submit'class='btn'value='确认' onclick='return pwdIsEmpty();'></td></tr>";
        echo " </table></form>";
    }
    //更改密码
    function changePassword($userId,$oldPassword,$newPassword){
        $userAdmin=new TableAdminForUsers();
        $result=$userAdmin->search($userId,$oldPassword);
        if ($result->num_rows>0){
            $userAdmin->update($userId,"",$newPassword);
            echo "<script>alert('修改密码成功！请重新登录！')</script>";
            header('Refresh:0; url=login.php');
            exit();
        }else{
            echo "<script>alert('修改密码失败，原始密码输入错误！')</script>";
            header('Refresh:0; url=person.php?action=changePwd');
            exit();
        }
    }
}