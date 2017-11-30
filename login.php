<?php
session_start();
header("Content-type:text/html;charset=utf-8");
    include "func.inc.php";
    $json_string = file_get_contents('config.json');
    $data = json_decode($json_string,true);
    $link = mysqli_connect($data['ip'],$data['name'],$data['pwd'],$data['basename']);
    $table = $data['table'];
    mysqli_set_charset($link,'utf8');
    $schoolnum = $_POST['schoolnum'];
    $pwd = sha1($_POST['pwd']);
    if(!$link){
        die('连接失败').mysqli_connect_error();
    }
    else{
        if(isset($_SESSION['flag'])){
           header("location:result.php");
           session_destroy();
        }
        else{
            if (empty($_POST['schoolnum'])) {
                echo "<script>alert('学号不能为空');location='login_html.php';</script>";
            }
            if (empty($_POST['pwd'])) {
                echo "<script>alert('密码不能为空');location='login_html.php';</script>";
            }
            if (login($link,$schoolnum,$pwd,$table) == 2) {
                echo "<script>alert('学号不存在');location='login_html.php';</script>";
                mysql_close();
                session_destroy();            
                }
            elseif(login($link,$schoolnum,$pwd,$table) == 0){
                echo "<script>alert('密码不正确');location='login_html.php';</script>";
            }
            else{
                if(isset($_POST['auto_login'])){
                    setcookie('schoolnum',$schoolnum,time()+60*10);
                    header("location:result.php");
                }
                else{
                    $_SESSION['schoolnum'] = $schoolnum;
                    header("location:result.php");
                }
            }
        }
    }
?>