<?php
	require_once "../../config.php";
	require_once "../../functions.php";
	// 1.0 获取相关参数
	$id = $_POST["id"];

	// 2.0 连接数据库，执行sql语句
	$connect = connect();
	// 2.1 编辑sql语句
	$sql = "UPDATE categories SET ";
	// 2.1.1 删除$_POST数组中的id
	unset($_POST["id"]);
	foreach ($_POST as $key => $value) {
		$sql .= "{$key}='{$value}',";
	}
	// 2.1.2 截取除了最后一个逗号之外的前面所有的字符
	$sql = substr($sql, 0, -1);
	// 2.2 拼接最终完成的字符串
	$sql .= " WHERE id = '{$id}'";
	$result = mysqli_query($connect, $sql);

	// 3.0 返回数据
	$response = ["code" => 0, "msg" => "操作失败"];
	if($result) {
		$response["code"] = 1;
		$response["msg"] = "操作成功";
	}

	header("Content-Type:application/json;charset=utf-8");
	echo json_encode($response);
?>