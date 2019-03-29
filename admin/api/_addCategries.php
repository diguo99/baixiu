<?php
    require_once '../../config.php';
    require_once '../../functions.php';
    //找数据
    $name=$_POST['name'];
    //连接
    $conn=connect();
    //sql语句
    $sql="SELECT count(id) as countId FROM categories WHERE `name`='{$name}'";
    //得数据
    $res=query($conn,$sql);
    //给前端
    $response=["code"=>0,"msg"=>"操作失败"];
    $count=$res[0]['countId'];
    if($count > 0){
        $response["msg"] = "分类名称已经存在，不能重复添加";
    }else{
        $keys=array_keys($_POST);
        $values=array_values($_POST);
        $addSql="INSERT INTO categories (". implode(",", $keys) .") VALUE('". implode("','", $values)  ."')";
        $conn=connect();
        $res =mysqli_query($conn,$addSql);
        if($res){
            $response["code"]=1;
            $response["msg"]="成功";
        }
        
    }
    header("Content-Type:application/json;chartset=utf-8");
  	echo json_encode($response);
?>