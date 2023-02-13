<?php

namespace Lib;

use Exception;

class Router
{
  private static $routes = [];

  public static function get(string $url, callable|array $callback)
  {
    $url = trim($url, '/');
    self::$routes['GET'][$url] = $callback;
  }

  public static function post(string $url, callable|array $callback)
  {
    $url = trim($url, '/');
    self::$routes['POST'][$url] = $callback;
  }

  public static function dispatch()
  {
    $uri = $_SERVER['REQUEST_URI'];
    $uri = trim($uri, '/');

    $method_http = $_SERVER['REQUEST_METHOD'];

    foreach (self::$routes[$method_http] as $route => $callback) {
      $expression_params = "#:[a-zA-Z]+#";

      if (strpos($route, ':') !== false) {
        $route = preg_replace($expression_params, '([a-zA-Z]+)', $route);
      }
      if (preg_match("#^$route$#", $uri, $matches)) {
        $params = array_splice($matches, 1);

        if (is_callable($callback) && !is_array($callback)) {
          $response = $callback(...$params);
        }

        if (is_array($callback)) {
          $controller = new $callback[0];
          $response = $controller->{'index'}(...$params);
        }

        if (is_array($response) || is_object($response)) {
          echo json_encode($response);
        } else {
          echo $response;
        }
        return;
      }
    }
    echo "Error 404";
  }
}
