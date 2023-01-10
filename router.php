<? class Router {

  private static $root;
  private static $routes;

  static function setRoutes ($routes) {
    self::$routes = $routes;
    return self::class;
  }
  
  static function setRoot ($root) {
    self::$root = $root;
    return self::class;
  }

  static function callControllerMethod ($route) {
    if ($route) $full_route = "{$_SERVER['REQUEST_METHOD']} /$route";
    else $full_route = self::$root;

    $re = '/^(.*)\s\/([:a-z]*)\/?([:a-z]*)?\/?$/m';
    preg_match($re, $full_route, $matches, PREG_UNMATCHED_AS_NULL);

    if (!$matches) return self::notFound();

    $request_method = $matches[1];
    $controller_name = $matches[2];
    $method_name = $matches[3] ? $matches[3] : 'index';
    
    if (!in_array(rtrim($full_route, '/'), self::$routes)) return self::notFound();


    require DIR . "controllers/$controller_name.php";

    $controller_name = ucfirst($controller_name);
    call_user_func("{$controller_name}Controller::$method_name");
  }

  static function notFound () {
    echo 'Not Found';
    return 0;
  }
}