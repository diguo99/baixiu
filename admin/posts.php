
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>Posts &laquo; Admin</title>
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
                <h1>所有文章</h1>
                <a href="post-add.php" class="btn btn-primary btn-xs">写文章</a>
            </div>
            <!-- 有错误信息时展示 -->
            <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
            <div class="page-action">
                <!-- show when multiple checked -->
                <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
                <form class="form-inline">
                    <select name="" class="selectBox form-control input-sm" id="category">
                        <option value="all">所有分类</option>
                    <script type="text/template" id="tempInfo">
                        <option value="all">所有分类</option>
                        <% for(var i=0;i<data.length;i++){ %>        
                        <option value="<%= data[i].id %>"><%= data[i].name%> </option>
                        <% } %>
                    </script>
                    </select>
                    <select id="status" name="" class="form-control input-sm" >
                        <option value="all">所有状态</option>
                        <option value="drafted">草稿</option>
                        <option value="published">已发布</option>
                        <option value="trashed">已作废</option>
                    </select>
                    <input type="button" value="筛选" class="btn btn-default btn-sm" id="btn-filt">
                </form>
                <ul class="pagination pagination-sm pull-right">
                    <li><a href="#">上一页</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">下一页</a></li>
                </ul>
            </div>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="40"><input type="checkbox"></th>
                        <th>标题</th>
                        <th>作者</th>
                        <th>分类</th>
                        <th class="text-center">发表时间</th>
                        <th class="text-center">状态</th>
                        <th class="text-center" width="100">操作</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <?php $current_Page = "posts";  ?>
    <?php  include_once './public/_aside.php' ;?>

    <script src="../static/assets/vendors/jquery/jquery.js"></script>
    <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
    <script>
        NProgress.done()
    </script>
    <script src="../static/assets/vendors/art-template/template-web.js"></script>
    
    <script type="text/template" id="tempData">
        <% 
        var status = {
          	"drafted": "草稿",          	
          	"published": "已发布",
			"trashed": "已作废"

        } 
        %>
        <% for(var i=0;i<data.length;i++){ %>
            <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td><%= data[i].title%></td>
                <td><%= data[i].nickname%></td>
                <td><%= data[i].name%></td>
                <td class="text-center"><%= data[i].created%></td>
                <td class="text-center"><%= status[data[i].status]%></td>
                <td class="text-center">
                    <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
                    <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
            </tr>
        <% } %>
    </script>
    <script>
        $(function(){
            var currentPage=1;
            var pageSize=10;
            $.ajax({
                type:'post',
                url:'./api/_getPostData.php',
                data:{
                    "currentPage":currentPage,
                    "pageSize":10,
                    "status":$("#status").val(),
                    "categoryId":$("#category").val()
                },
                success:function(res){
                    var html=template("tempData",res)
                    $("tbody").html(html)
                    pageCount = res.pageCount
                    setPagination()
                }
            })
            setPagination();
            function setPagination(){
                var pageCount
                var pageSize
                var start=currentPage-2;
                start=start<1?1:start;
                var end=start+4
                end=end>pageCount?pageCount:end;
                var html=''
                if(currentPage!=1){
                    html = '<li class="item" data-page="'+ (currentPage - 1) +'"><a href="javascript:;">上一页</a></li>';
                }
                for(var i = start; i <= end; i++) {
  	            if(i == currentPage) {
      	            html += '<li class="item active" data-page="'+ i +'"><a href="javascript:;">'+ i +'</a></li>';
  	            } else {
      	            html += '<li class="item" data-page="'+ i +'"><a href="javascript:;">'+ i +'</a></li>';
                }
                }
                if(currentPage != pageCount) {
  	                html += '<li class="item" data-page="'+ (currentPage + 1) +'"><a href="javascript:;">下一页</a></li>';
                }
                $(".pagination").html(html);
            }
            //分页
            $(".pagination").on('click','.item',function(){
                currentPage=parseInt($(this).attr('data-page'))
                $.ajax({
                    type:'post',
                    url:'./api/_getPostData.php',
                    data:{
                        "currentPage":currentPage,
                        "pageSize":10,
                        "status":$("#status").val(),
                        "categoryId":$("#category").val()
                    },
                    success:function(res){
                        setPagination()
                        var html=template("tempData",res)
                        $("tbody").html(html)
                    }
                })
            })

            $.ajax({
                type:'post',
                url:'./api/_getCategriesData.php',
                success:function(res){
                    if(res.code==1){
                        var html=template("tempInfo",res)
                        $("#category").html(html)
                    }
                }
            })
            //点击筛选
            $("#btn-filt").on("click", function() {
                var status = $("#status").val();
                console.log(status);
                
  	            // 获取分类的id
  	            var categoryId = $("#category").val();
                  console.log(categoryId);
                  
  	        $.ajax({
              	type: "POST",
              	url: "api/_getPostData.php",
              	data: {
                    "currentPage": currentPage,
          	        "pageSize": 10,
                    "status":status,
                    "categoryId":categoryId
                },
              	success: function(res) {
                  	if(res.code == 1) {
                        setPagination()
                        var html=template("tempData",res)
                        $("tbody").html(html)
                        pageCount = res.pageCount
                  	}
              	    }
  	            })
            })

        })



    </script>
</body>

</html>