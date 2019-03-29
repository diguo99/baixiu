<?php
    require_once '../../config.php';
    require_once '../../functions.php';

    $pageSize=$_POST['pageSize'];
    $currentPage=$_POST['currentPage'];
    $offset=($currentPage-1)*$pageSize;

    $conn=connect();

    $sql="SELECT c.id,c.author,c.content,c.created,c.`status`,p.title FROM comments c
        LEFT JOIN posts p ON p.id =c.post_id
        LIMIT {$offset},{$pageSize}";
    $res=query($conn,$sql);

    $sql2="SELECT count(id) as count FROM comments";

    $arr=query($conn,$sql2);
    $pageCount=$arr[0]['count'];
    $response=["code"=>0,"msg"=>'操作失败'];
    if($res){
        $response["code"]=1;
        $response["msg"]='操作成功';
        $response['data']=$res;
        $response['pageCount']=$pageCount;
    }
    header('Content-Type:application/json;charset=utf-8');
    echo json_encode($response);
?>