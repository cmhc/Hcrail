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

### useage ###

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
