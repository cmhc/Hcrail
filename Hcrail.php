<?php
namespace cmhc\Hcrail;

class Hcrail
{

    /**
     * callback function
     * @var callable
     */
    protected static $callback;

    /**
     * match string or match regexp
     * @var string
     */
    protected static $match;

    protected static $routeFound = false;

    /**
     * deal with get,post,head,put,delete,options,head
     * @param   $method
     * @param   $arguments
     * @return
     */
    public static function __callstatic($method, $arguments)
    {
        self::$match = str_replace("//", "/", dirname($_SERVER['PHP_SELF']) . '/' . $arguments[0]);
        self::$callback = $arguments[1];
        self::dispatch();
        return;
    }

    /**
     * processing ordinary route matches
     * @param  string $requestUri
     * @return
     */
    public static function normalMatch($requestUri)
    {
        if (self::$match == $requestUri) {
            self::$routeFound = true;
            call_user_func(self::$callback);
        }
        return;
    }

    /**
     * processing regular route matches
     * @param  string $requestUri
     * @return
     */
    public static function regexpMatch($requestUri)
    {
        //处理正则表达式
        $regexp = self::$match;
        preg_match("#$regexp#", $requestUri, $matches);
        if (!empty($matches)) {
            self::$routeFound = true;
            call_user_func(self::$callback, $matches);
        }
        return;
    }

    /**
     * dispatch route
     * @return
     */
    public static function dispatch()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (strpos(self::$match, '(') === false) {
            self::normalMatch($requestUri);
        } else {
            self::regexpMatch($requestUri);
        }

    }

    /**
     * 查询是否路由未发现
     */
    public static function isNotFound()
    {
        return !self::$routeFound;
    }

}
