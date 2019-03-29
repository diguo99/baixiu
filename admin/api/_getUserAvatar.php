<?php
    require_once '../../config.php';
    require_once '../../functions.php';
    

    session_start();
    $user_id=$_SESSION['user_id'];

    $conn=connect();
    $sql="SELECT * FROM users WHERE id={$user_id}";
    $res=query($conn,$sql);
    $response=["code"=>0,"msg"=>"操作失败"];
    if($res){
        $response["code"]=1;
        $response["msg"]="连接成功";
        $response["avatar"]=$res[0]["avatar"];
        $response["nickname"]=$res[0]["nickname"];
    }
    header("content-type:application/json;charset=utf-8");
    echo json_encode($response);
?>