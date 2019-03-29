<?php
require_once './config.php';
//创建连接
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
//书写mysql语句
$sql = 'SELECT * FROM categories WHERE id!=1';
//查询
$res = mysqli_query($conn, $sql);
//从结果当中取数据
$arr = [];
while ($row = mysqli_fetch_assoc($res)) {
    $arr[] = $row;
}

?>
<div class="header">
            <h1 class="logo">
                <a href="index.php"><img src="static/assets/img/logo.png" alt=""></a>
            </h1>
            <ul class="nav">
                <!-- <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
                <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
                <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
                <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li> -->
                <?php foreach ($arr as $value) {?>
                    <li><a href="list.php?categoryId=<?php echo $value['id']; ?>"><i class="fa <?php echo $value['classname']; ?>"></i><?php
echo $value['name']; ?></a></li>
                <?php }?>

            </ul>
            <div class="search">
                <form>
                    <input type="text" class="keys" placeholder="输入关键字">
                    <input type="submit" class="btn" value="搜索">
                </form>
            </div>
            <div class="slink">
                <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
            </div>
        </div>
</div>