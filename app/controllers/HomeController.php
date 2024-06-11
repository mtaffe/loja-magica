<?php

//session_start();

require ('vendor/autoload.php');

class HomeController extends RenderView
{
  private $authenticated;
  public function __construct()
  {
    $this->authenticated = isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ? 1 : 0;
  }

  public function logout()
  {
    unset($_SESSION['user_id']);
    header("Location: " . BASE_URL . "login");
  }

  public function index($id)
  {
    $auth = $this->authenticated;

    $user = new UserModel();
    $user = $user->fetchUserById(isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0);

    $this->loadView('pages/partials/header', [
      "title" => "Home Page",
      'isAuth' => $auth,
      'user' => $user
    ]);
    $this->loadView('pages/partials/sidebar', [
      "title" => "Home Page",
      'isAuth' => $auth,
      'user' => $user
    ]);
    $this->loadView('pages/home', [
      'isAuth' => $auth,
    ]);
    $this->loadView('pages/partials/footer', []);
  }

  public function login()
  {
    $auth = $this->authenticated;

    if ($auth == 1) {
      header("Location: " . BASE_URL);
    }

    $this->loadView('pages/partials/header', [
      "title" => "Login",
      'isAuth' => $auth
    ]);
    $this->loadView('pages/login', []);
    $this->loadView('pages/partials/footer', []);
  }

  public function verifyCredentials()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      header('Location: ' . BASE_URL . 'login');
    }

    $msg = [];
    $userModel = new UserModel();

    if (
      (isset($_POST['email']) && !empty($_POST['email'])) || (isset($_POST['passwd']) && !empty($_POST['passwd']))
    ) {
      $email = $_POST['email'];
      $passwd = $_POST['password'];

      $user = $userModel->login($email, $passwd);

      if ($user) {
        $msg['success'] = "Usuário autenticado com sucesso!";
        $_SESSION['user_id'] = $user;
        header('Location: ' . BASE_URL);
        exit();
      } else {
        $msg['error'] = "Usuário não autenticado!";
      }
    } else {
      $msg['error'] = "Usuário não autenticado!";
    }

    echo json_encode($msg);
  }
}