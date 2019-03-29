<?php
    require_once '../config.php';
    require_once '../functions.php';

    //获取参数
    $categoryId=$_POST["categoryId"];
    $currentPage=$_POST["currentPage"];
    $pageSize=$_POST["pageSize"];

    $offset=($currentPage-1)*$pageSize;
    //连接数据库
    $conn=connect();
    //sql语句

    $sql="SELECT p.id,p.title,p.feature,p.created,p.content,p.likes,p.views,c.`name`,u.nickname,(SELECT (COUNT(id)) FROM comments  WHERE comments.post_id=p.id) AS commentsCount FROM posts p
    LEFT JOIN users u ON u.id=p.user_id 
    LEFT JOIN categories c ON c.id=p.category_id
    WHERE p.category_id = {$categoryId}
    ORDER BY p.created DESC
    LIMIT {$offset},{$pageSize}";

    $sql2="SELECT count(id) as pageCount FROM posts WHERE category_id={$categoryId}";
    //查询
    $newArr=query($conn,$sql);
    $postArr=query($conn,$sql2);
    $pageCount=$postArr[0]["pageCount"];
    //返回给前端的接口数据
    $response=["code"=>0,"msg"=>"请求数据失败"];
    if($newArr){
        $response["code"]=1;
        $response["msg"]="请求成功";
        $response["data"]=$newArr;
        $response["pageCount"]=$pageCount;
    }
    //设置响应头并输出结果
    header("Content-Type:application/json;charset=UTF-8");
    echo json_encode($response);
?>