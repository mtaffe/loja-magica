<?php

session_start();

class Core
{
  private $routes;
  private $authenticated;

  public function __construct($routes)
  {
    $this->setRoutes($routes);
    $this->authenticated = isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ? 1 : 0;
  }

  public function run()
  {
    $url = '/';

    isset($_GET['url']) ? $url .= $_GET['url'] : '';

    ($url != '/') ? $url = rtrim($url, '/') : $url;

    $routerFound = false;

    if ($url == '/login') {
      require_once __DIR__ . "/../controllers/HomeController.php";

      $controller = new HomeController();
      $controller->login();
      return;
    }

    if ($url == '/verify') {
      require_once __DIR__ . "/../controllers/HomeController.php";

      $controller = new HomeController();
      $controller->verifyCredentials();
      return;
    }

    if (!$this->authenticated) {
      return header("Location: " . BASE_URL . "login");
    }

    foreach ($this->getRoutes() as $path => $controllerAndAction) {
      $pattern = '#^' . preg_replace('/{id}/', '([\w-]+|\d+)', $path) . '$#';

      if (preg_match($pattern, $url, $matches)) {
        array_shift($matches);

        $routerFound = true;

        [$currentController, $action] = explode('@', $controllerAndAction);

        require_once __DIR__ . "/../controllers/$currentController.php";

        $controller = new $currentController();
        $controller->$action($matches);
      }
    }

    if (!$routerFound) {
      require_once __DIR__ . "/../controllers/NotFoundController.php";
      $controller = new NotFoundController();
      $controller->index();
    }
  }

  protected function getRoutes()
  {
    return $this->routes;
  }
  protected function setRoutes($routes)
  {
    $this->routes = $routes;
  }
}
