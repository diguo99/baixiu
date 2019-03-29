<?php
    require_once '../../config.php';
    require_once '../../functions.php';
    //连接
    $conn=connect();
    //sql
    $sql='select * from categories';
    //获取数据
    $res=query($conn,$sql);
    //数据发送给前端
    $response=["code"=>0,"msg"=>"操作失败"];
    if($res){
        $response["code"]=1;
        $response["msg"]="操作成功";
        $response["data"]=$res;
    }
    //响应头
    header("Content-Type:application/json;charset=UTF-8");
    echo json_encode($response);
?>