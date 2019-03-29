<div class="aside">
        <div class="profile">
            <img class="avatar" src="../static/uploads/avatar.jpg">
            <h3 class="name">布头儿</h3>
            <?php
                $arr=['posts','post-add','categories'];
                $bool = in_array($current_Page,$arr);
                $arr2=['settings','slides','users'];
                $bool2=in_array($current_Page,$arr2);
            ?>
        </div>
        <ul class="nav">
            <li class="<?php  echo $current_Page=="index" ? "active" : "" ?>">
                <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
            </li>
            <li>
                <a href="#menu-posts" class="<?php echo $bool ? "" : "collapsed" ?>" 
                data-toggle="collapse" <?php echo $bool ? 'aria-expanded="true"' : "" ?>>
                    <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
                </a>
                <ul id="menu-posts" class="collapse <?php echo $bool ? "in" : "" ?>"
                 <?php echo $bool ? 'aria-expanded="true"' : "" ?>>
                    <li class="<?php  echo $current_Page=="posts" ? "active" : "" ?>"><a href="posts.php">所有文章</a></li>
                    <li class="<?php  echo $current_Page=="post-add" ? "active" : "" ?>"><a href="post-add.php">写文章</a></li>
                    <li class="<?php  echo $current_Page=="categories" ? "active" : "" ?>"><a href="categories.php">分类目录</a></li>
                </ul>
            </li>
            <li class="<?php  echo $current_Page=="comments" ? "active" : "" ?>">
                <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
            </li>
            <li class="<?php  echo $current_Page=="users" ? "active" : "" ?>">
                <a href="users.php"><i class="fa fa-users"></i>用户</a>
            </li>
            <li>
                <a href="#menu-settings" class="<?php echo $bool2 ? "" : "collapsed" ?>" 
                data-toggle="collapse" <?php echo $bool2 ? 'aria-expanded="true"' : "" ?>>
                    <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
                </a>
                <ul id="menu-settings" class="collapse <?php echo $bool2 ? "in" : "" ?>"
                <?php echo $bool2 ? 'aria-expanded="true"' : "" ?>>
                    <li class="<?php  echo $current_Page=="nav-menus" ? "active" : "" ?>"><a href="nav-menus.php">导航菜单</a></li>
                    <li class="<?php  echo $current_Page=="slides" ? "active" : "" ?>"><a href="slides.php">图片轮播</a></li>
                    <li class="<?php  echo $current_Page=="settings" ? "active" : "" ?>"><a href="settings.php">网站设置</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <script src="../static/assets/vendors/jquery/jquery.min.js"></script>
    <script>
        $.ajax({
            type:'post',
            url:'api/_getUserAvatar.php',
            success:function(res){
                console.log(res);
                if(res.code==1){
                    var profile = $(".profile");
          	        profile.children('img').attr("src", res.avatar);
          	        profile.children('h3').text(res.nickname);
                }
            }
        })
    </script>