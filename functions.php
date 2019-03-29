<?php
//连接数据库
function connect()
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    return $conn;
}
//查询sql语句
function query($conn, $sql)
{
    $res = mysqli_query($conn, $sql);
    return fetch($res);
}
//
function fetch($res)
{
    $newArr = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $newArr[] = $row;
    }
    return $newArr;
}
function checkLogin()
{
    session_start();
    if (!isset($_SESSION['isLogin']) || $_SESSION["isLogin"] != 1) {
        header("Location:login.php");
    }
}
function insert($connect, $table, $arr)
{
    $keys = array_keys($arr);
    $values = array_values($arr);
    $sqlAdd = "INSERT into {$table} " . implode(",", $keys) . " VALUES ('" . implode("','", $values) . "')";
    return mysqli_query($connect, $sqlAdd);
}
