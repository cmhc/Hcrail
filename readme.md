Hcrail
======

Hcrail is a simple PHP Router, just less than 100 lines of code. 

### install ###

If you have composer, just inlcude Hcrail as a project dependency in your `composer.json`,or you can download this zip file and extracting it to your project.

```
require: {
	"cmhc/Hcrail": "dev-master"
}
```

### usage ###

use namespace

```
use cmhc\Hcrail\Hcrail;
```

Normal match

```
use cmhc\Hcrail\Hcrail;

Hcrail::get("/",function(){
	echo 'hello';
});
```
open your browser, type `http://localhost/Hcrail/` in the address bar, and you will see "hello" in the browser.


Regular match

```
Hcrail::get("/([0-9]*)\.html",function($args){
	echo $args[1];
});
```

Hcrail can support regular match, regular expressions need be surrounded by parentheses,then the callback function parameters is the matching result.

type `http://localhost/Hcrail/6666.html` in the browser address bar and you will seee "6666" in browser window.

### config ###

apache

We need to create a file called .htaccess and go into the following sections

```
RewriteEngine On
RewriteBase /Hcrail

RewriteCond %{REQUEST_FILENAME}% !-f
RewriteCond %{REQUEST_FILENAME}% !-d

RewriteRule ^.*$ index.php [L]
```

nginx

We need modify the file named nginx.conf, as follows

```
location / {
	try_files $uri $uri/ /index.php?/$uri;
}
```


Hcrail
======

Hcrail是一个简单的PHP路由，代码不到100行

### 使用 ###

如果你安装了composer，可以直接用composer吧Hcrail集成到你的项目中去，使用如下代码

```
require: {
	"cmhc/Hcrail": "dev-master"
}
```

Hcrail支持普通匹配和正则匹配，如下

普通匹配，匹配首页
```
use cmhc\Hcrail\Hcrail;

Hcrail::get("/",function(){
	echo 'hello';
});
```

正则匹配，匹配类似 http://localhost/6666.html 的地址
```
Hcrail::get("/([0-9]*)\.html",function($args){
	echo $args[1];
});
```

### 服务器配置 ###

apache
在根目录建立 .htaccess 文件 
```
RewriteEngine On
RewriteBase /Hcrail

RewriteCond %{REQUEST_FILENAME}% !-f
RewriteCond %{REQUEST_FILENAME}% !-d

RewriteRule ^.*$ index.php [L]
```

nginx

```
location / {
	try_files $uri $uri/ /index.php?/$uri;
}
```