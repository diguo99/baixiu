# baixiu
记录小舅子的项目;

搭建过程:
### 1. 克隆代码:
```
git clone https://github.com/diguo99/baixiu
```
### 2. 创建数据库:db_baixiu,编码:utf-8 校对集:utf8-generic-ci
### 3. 导入数据库db_baixiu.sql
### 4. nginx配置:
```
server {
    listen       80 ;   
    server_name  baixiu.com; 
    root         D:/phpStudy/WWW/baixiu;  
    location / {
        index  index.php index.html index.htm;  
    }
    location ~* \.php$ {   
        fastcgi_index   index.php;
        fastcgi_pass    127.0.0.1:9000;
        include         fastcgi_params;
        fastcgi_param   SCRIPT_FILENAME    $document_root$fastcgi_script_name;
        fastcgi_param   SCRIPT_NAME        $fastcgi_script_name;
    }
    error_page 404 /404.html;   
        location = /40x.html {
    }
    error_page 500 502 503 504 /50x.html;
        location = /50x.html {
    }
}
```

### 5. host配置:
```
127.0.0.1	baixiu.com
```

### 6. 访问浏览器:baixiu.com 即可进入项目.项目首页截图:
https://img-blog.csdnimg.cn/20190329153758168.png
