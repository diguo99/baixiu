
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Categories &laquo; Admin</title>
    <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../static/assets/vendors/nprogress/nprogress.css">
    <link rel="stylesheet" href="../static/assets/css/admin.css">
    <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
</head>

<body>
    <script>
        NProgress.start()
    </script>

    <div class="main">
    <?php include_once './public/_navbar.php'; ?>
        <div class="container-fluid">
            <div class="page-title">
                <h1>分类目录</h1>
            </div>
            <!-- 有错误信息时展示 -->
            <div class="alert alert-danger" style="display: none;">
                <strong>错误！</strong>
                <span id="msg"></span>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <form id="data">
                        <h2>添加新分类目录</h2>
                        <div class="form-group">
                            <label for="name">名称</label>
                            <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
                        </div>
                        <div class="form-group">
                            <label for="slug">别名</label>
                            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
                            <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
                        </div>
                        <div class="form-group">
                            <label for="classname">类名</label>
                            <input id="classname" class="form-control" name="classname" type="text" placeholder="classname">
                            <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
                        </div>
                        <div class="form-group">
                            <span class="btn btn-primary" type="submit" id="btn-add">添加</span>
                            <input style="display: none;" id="btn-edit" class="btn btn-primary" type="button" value="编辑完成">
                            <input style="display: none;" id="btn-cancel" class="btn btn-primary" type="button" value="取消编辑">
                        </div>
                        
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="page-action">
                        <!-- show when multiple checked -->
                        <a id="delAll" class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" width="40"><input type="checkbox"></th>
                                <th>名称</th>
                                <th>Slug</th>
                                <th>类名</th>
                                <th class="text-center" width="100">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="aside">
        <div class="profile">
            <img class="avatar" src="../static/uploads/avatar.jpg">
            <h3 class="name">布头儿</h3>
        </div>
        <ul class="nav">
            <li>
                <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
            </li>
            <li class="active">
                <a href="#menu-posts" data-toggle="collapse">
                    <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
                </a>
                <ul id="menu-posts" class="collapse in">
                    <li><a href="posts.php">所有文章</a></li>
                    <li><a href="post-add.php">写文章</a></li>
                    <li class="active"><a href="categories.php">分类目录</a></li>
                </ul>
            </li>
            <li>
                <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
            </li>
            <li>
                <a href="users.php"><i class="fa fa-users"></i>用户</a>
            </li>
            <li>
                <a href="#menu-settings" class="collapsed" data-toggle="collapse">
                    <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
                </a>
                <ul id="menu-settings" class="collapse">
                    <li><a href="nav-menus.php">导航菜单</a></li>
                    <li><a href="slides.php">图片轮播</a></li>
                    <li><a href="settings.php">网站设置</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <?php $current_Page = "categories";  ?>
    <?php  include_once './public/_aside.php' ?>
    <script src="../static/assets/vendors/jquery/jquery.js"></script>
    <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script src="../static/assets/vendors/art-template/template-web.js"></script>
    <script type="text/template" id="template">
    <% for(var i=0;i<data.length;i++){ %>
    <tr data-categoryId="<%= data[i].id %>">
        <td class="text-center"><input type="checkbox"></td>
        <td><%= data[i].name %></td>
        <td><%= data[i].slug %></td>
        <td><%= data[i].classname %></td>
        <td class="text-center">
            <a href="javascript:;"  class="edit btn btn-info btn-xs">编辑</a>
            <a href="javascript:;"  class="del btn btn-danger btn-xs">删除</a>
        </td>
    </tr>
    <% } %>                        
    </script>
    <script>
        NProgress.done()
    </script>
</body>

</html>

<script>
$(function(){
    $.ajax({
        type:'post',
        url:'./api/_getCategriesData.php',
        dataType:'json',
        success:function(res){
            if(res.code == 1) {
                var html = template("template", res)
                $("tbody").html(html);
            }
        }
    })
    $("#btn-add").on('click',function(){
        //获取表单数据
        var name=$('#name').val()
        var slug=$('#slug').val()
        var classname=$('#classname').val()
        //判断是否为空
        if($.trim(name)==''){
            $('.alert').show()
            $('#msg').fadeIn(500).text('用户名不能为空')
            return
        }
        if($.trim(slug)==''){
            $('.alert').show()
            $('#msg').fadeIn(500).text('别名不能为空')
            return
        }
        if($.trim(classname)==''){
            $('.alert').show()
            $('#msg').fadeIn(500).text('类名不能为空')
            return
        }
        var categoryId = $(this).data("categoryId");
        $.ajax({
        type:'post',
        url:'./api/_addCategries.php',
        data:$('#data').serialize(),
        success:function(res){
            if(res.code==1){
            var html=template("template",{data:[
                {
                    "name":name,
                    "slug":slug,
                    "classname":classname,
                    "id" :categoryId
                }
            ]})
            $("tbody").append(html);
                }
            }
            })
        })
        //编辑
    var currentRow;
    $("tbody").on("click", ".edit", function() {
        currentRow = $(this).parent().parent();
        var categoryId = $(this).parents("tr").attr("data-categoryId");
        console.log(categoryId);
        
        $("#btn-edit").attr("data-categoryId", categoryId);
        $("#btn-add").hide();
        $("#btn-edit, #btn-cancel").show();
        // 按钮对应的数据填充到对应的输入框
        var name = $(this).parent().parent().children().eq(1).text();
        var slug = $(this).parent().parent().children().eq(2).text();
        var classname = $(this).parent().parent().children().eq(3).text();
        $("#name").val(name);
        $("#slug").val(slug);
        $("#classname").val(classname);
        })
    $("#btn-edit").on("click", function() {
        // 获取对应的id
        var categoryId = $(this).parents("tr").attr("data-categoryId");
        // 完成表单的非空验证
        var name = $("#name").val()
        var slug = $("#slug").val()
        var classname = $("#classname").val()
        
        if(name == "") {
            $("#msg").text("分类的名称不能为空")
            $(".alert").show()
            return
        }
        if(slug == "") {
            $("#msg").text("分类的别名不能为空")
            $(".alert").show()
            return
        }
        if(classname == "") {
            $("#msg").text("分类的图标样式为空")
            $(".alert").show()
            return
        }
        $.ajax({
            url: "api/_updateCategory.php",
            type: "post",
            data:{
                "name":name,
                "slug":slug,
                "classname":classname,
                "id" :categoryId
                },
            success: function(res) {
            // 如果修改成功
            if(res.code == 1) {
                // 两个编辑的按钮隐藏，添加的按钮显示
                $("#btn-add").show();
                $("#btn-edit, #btn-cancel").hide();
    
                // 清空之前先保存之前的内容
                var name = $("#name").val();
                var slug = $("#slug").val();
                var classname = $("#classname").val();
                // 清空输入框
                $("#name").val("");
                $("#slug").val("");
                $("#classname").val("");
    
                // 添加数据到页面 
                currentRow.children().eq(1).text(name);
                currentRow.children().eq(1).text(slug);
                currentRow.children().eq(1).text(classname);
                }
      	    }
            })
            $("#btn-cancel").on("click", function() {
                // 两个编辑的按钮隐藏，添加的按钮显示
                $("#btn-add").show();
                $("#btn-edit, #btn-cancel").hide();
                // 清空输入框
                $("#name").val("");
                $("#slug").val("");
                $("#classname").val("");
            })
        })

    //单个删除
    $("tbody").on('click','.del',function(){
        var tr=$(this).parent().parent()
        var categoryId = tr.attr("data-categoryId");
        console.log(categoryId);
        $ajax({
            type:'post',
            url:'./api/_delCategory.php',
            data: {
          	"id": categoryId
      	    },
            success:function(res){
                if(res.code == 1) {
              	tr.remove();
          	    }
            }
        })
    })
    //批量删除
    $("thead input").on("click",function(){
        var status = $(this).prop("checked");
  	    // 全选和全不选
  	    $("tbody input").prop("checked", status);
    })
    $("tbody").on("click",":checkbox",function(){
        var theadCheck=$(":checked")
        var length1=$("tbody:checkbox").size()
        var length2=$("tbody:checked").size()
        theadCheck.prop("check",length1==length2)
        if($("tbody :checked").size()>=2){
            $("#delAll").fadeIn(500)
        }else{
            $("delAll").hide()
        }
    })
    $("#delAll").on('click',function(){
        var idArr=[]
        var checkedBox=$("tbody:checked")
        checkedBox.each(function(index,el){
            var id=$(el).parents("tr").attr("data-categoryId")
            idArr.push(id)
        })
        $.ajax({
            type:'post',
            url:'./api/_delCategories.php',
            data:{
                "idArr":idArr
            },
            success:function(){
                if(res.code==1){
                    checkedBox.parents("tr").remove()
                }
            }
        })
    })
})        
</script>