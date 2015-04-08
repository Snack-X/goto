<?php
/**
 * Simple router.
 * Based on RegexRouter (http://upshots.org/php/php-regexrouter)
 */

class Router {
	private static $routes = array();
	private static $last_route = array();

	public static function on($method, $pattern, $controller, $action) {
		$method = strtolower($method);

		if(!isset(self::$routes[$method])) {
			self::$routes[$method] = array();
		}

		$pattern = "/^".str_replace("/", "\/", $pattern)."(\?.*)?\/?$/";

		self::$routes[$method][$pattern] = array($controller, $action);
	}

	public static function get($pattern, $controller, $action) {
		self::on("get", $pattern, $controller, $action);
	}

	public static function post($pattern, $controller, $action) {
		self::on("post", $pattern, $controller, $action);
	}

	public static function last($controller, $action) {
		self::$last_route = array($controller, $action);
	}

	public static function run() {
		global $mysqli, $config;

		$uri = $_SERVER["REQUEST_URI"];
		$method = $_SERVER["REQUEST_METHOD"];

		$method = strtolower($method);

		foreach(self::$routes[$method] as $pattern => $callback) {
			if(preg_match($pattern, $uri, $params) === 1) {
				require_once "../controller/".$callback[0].".php";

				$ctrl = $callback[0]."Controller";
				$controller = new $ctrl($mysqli, $config);

				array_shift($params);
				return call_user_func_array(array($controller, $callback[1]), array_values($params));
			}
		}

		require_once "../controller/".self::$last_route[0].".php";

		$ctrl = self::$last_route[0]."Controller";
		$controller = new $ctrl($mysqli, $config);

		return call_user_func_array(array($controller, self::$last_route[1]), array());
	}
}