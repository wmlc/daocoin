laravel 部署流程

1、修改文件权限
```
sudo chmod 777 public/

sudo chmod 777 storage/
```
2、nginx配置 
```
server
    {
        listen 8091;
        #listen [::]:80;
        server_name daocoin.itcode.wiki;
        index index.html index.htm index.php default.html default.htm default.php;
        root  /alidata/www/daocoin/public;
        
        charset utf-8;

        error_page   404   /index.php;

        # Deny access to PHP files in specific directory
        #location ~ /(wp-content|uploads|wp-includes|images)/.*\.php$ { deny all; }

        location / {
           try_files $uri $uri/ /index.php?$query_string;
        }
        
        location = /favicon.ico { access_log off; log_not_found off; }
        location = /robots.txt  { access_log off; log_not_found off; }

        location ~ [^/]\.php(/|$)
        {
            try_files $uri =404;
            fastcgi_pass  unix:/tmp/php-cgi.sock;
            fastcgi_index index.php;
            include fastcgi.conf;
        }

        location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
        {
            expires      30d;
        }

        location ~ .*\.(js|css)?$
        {
            expires      12h;
        }

        location ~ /.well-known {
            allow all;
        }

        location ~ /\.
        {
            deny all;
        }
        
        access_log /alidata/log/nginx/access/itcode.wiki.log;
    }

```
3、配置 open_basedir

```
[HOST=daocoin.itcode.wiki]
open_basedir=/alidata/www/daocoin/:/tmp/
[PATH=/alidata/www/daocoin/public]
open_basedir=/alidata/www/daocoin/:/tmp/
```

4、生成秘钥
```angularjs
php artisan key:generate
```
5、生成配置缓存（生产环境执行）
```angularjs
php artisan config:cache
```
6、优化自动加载（生产环境执行）
```angularjs
composer install --optimize-autoloader
```
7、优化路由加载
```angularjs
php artisan route:cache
```