<?php
    require_once '../config.php';
    require_once '../functions.php';
    
    $email=$_POST['email'];
    $password=$_POST['password'];
    $conn=connect();
    $sql="SELECT * FROM users WHERE email='{$email}'  AND `password`='{$password}' AND `status`='activated'";
    $res=query($conn,$sql);
    // print_r($res);
    $response=["code"=>0 ,"msg"=>"操作失败"];
    if($res){
        session_start();
        $_SESSION['isLogin']=1;
        $_SESSION['user_id']=$res[0]['id'];
        $response["code"]=1;
        $response["msg"]="操作成功";
    }
    header("Content-Type:application/json;charset=utf-8");
    echo json_encode($response);
?>