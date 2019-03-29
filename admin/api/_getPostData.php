<?php
    require_once '../../config.php';
    require_once '../../functions.php';
    
    
    $currentPage=$_POST['currentPage'];
    $pageSize=$_POST['pageSize'];

    //接受额外的参数
      $status=$_POST['status'];
    

    $offset=($currentPage-1)*$pageSize;
    $conn=connect();
    $where=" WHERE 1=1";
    if($status != "all") {
        $where .= " AND p.status = '{$status}' ";
    }
    $categoryId=$_POST['categoryId'];
    if($categoryId != "all") {
        $where .= " AND p.category_id = '{$categoryId}' ";
    }
    $sql = "SELECT p.id,p.title,p.`status`,p.created,u.nickname,c.`name` FROM posts p
			LEFT JOIN users u ON u.id = p.user_id
			LEFT JOIN categories c ON c.id = p.category_id ".$where. 
			" LIMIT {$offset},{$pageSize}";   
    $res=query($conn,$sql);

    $sql1="select count(*) as count from posts";
    $res1=query($conn,$sql1);
    $countSql = "SELECT count(*) as count FROM posts";
	$countArr = query($conn, $sql);
	$postCount = $res1[0]["count"];
	$pageCount = ceil($postCount / $pageSize);

    $response=["code"=>0 ,"msg"=>"操作失败"];
    if($res){
        $response["code"]=1;
        $response["msg"]="操作成功";
        $response["data"]=$res;
        $response["pageCount"] = $pageCount;
    }
    header("Content-Type:application/json;charset=utf-8");
    echo json_encode($response);
?>