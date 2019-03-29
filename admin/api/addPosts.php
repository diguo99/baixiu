<?php
    require_once '../../config.php';
    require_once '../../functions.php';

    

    $arr=$_POST;
    $conn=connect();
    $sql='';
    $res=query($conn,$sql)
    $response=["code"=>0,"msg"=>'操作失败'];
    if($res){
        $response["code"]=>1;
        $response["msg"]=>'操作成功';
    }
    header('Content-Type:application/json;charset=utf-8');
    echo json_encode($response);
?>