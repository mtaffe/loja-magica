<?php

require('vendor/autoload.php');

class ClientController extends RenderView
{
    private $authenticated;
    private $model;

    public function __construct()
    {
        // $this->model = new ClientModel();
        $this->authenticated = isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ? 1 : 0;
    }


    public function index()
    {
        $model = new ClientModel();
        $type = $_POST;

        $clients = $model->findAll();

        $user = new UserModel();
        $user = $user->fetchUserById($_SESSION['user_id']);

        $this->loadView('pages/partials/header', [
            "title" => "Lista de clientes",
        ]);
        $this->loadView('pages/partials/sidebar', [
            "title" => "Lista de clientes",
            //'isAuth' => $auth,
            'user' => $user
        ]);
        $this->loadView('pages/clients', ['clients' => $clients]);
        $this->loadView('pages/partials/footer', []);
        return;
    }

    public function create()
    {
        $auth = $this->authenticated;

        $user = new UserModel();
        $user = $user->fetchUserById($_SESSION['user_id']);

        $this->loadView('pages/partials/header', [
            "title" => "Novo Cliente",
        ]);
        $this->loadView('pages/partials/sidebar', [
            "title" => "Novo Cliente",
            'isAuth' => $auth,
            'user' => $user
        ]);
        $this->loadView('pages/client-form', []);
        $this->loadView('pages/partials/footer', []);
    }

    public function store()
    {
        try {
            $model = new ClientModel();

            $client = $_POST;
            $client = $model->create($client['name'], $client['email'], $client['type'], $client['last_order_date'], $client['last_order_cost']);

            echo json_encode(['success' => 'Cliente cadastrado com sucesso!', 'client' => $client]);
            exit();
        } catch (Exception $e) {
            return false;
        }
    }

    public function edit($id)
    {
        $model = new ClientModel();

        $user = new UserModel();
        $user = $user->fetchUserById($_SESSION['user_id']);

        $model = new ClientModel();

        $client = $model->findOne($id[0]);

        $this->loadView('pages/partials/header', [
            "title" => "Editar Cliente",
        ]);
        $this->loadView('pages/partials/sidebar', [
            "title" => "Editar Cliente",
            //'isAuth' => $auth,
            'user' => $user
        ]);
        $this->loadView('pages/client-form', ['client' => $client]);
        $this->loadView('pages/partials/footer', []);
    }

    public function update($id)
    {
        try {
            $model = new ClientModel();

            $client = $_POST;
            $client = $model->update($id[0], $client['name'], $client['email'], $client['last_order_date'], $client['last_order_cost']);

            if (!isset($client)) {
                $msg['error'] = "Deu ruim!";
                echo json_encode($msg);
                return;
            }

            $msg['success'] = "Produto criado com sucesso!";
            echo json_encode(['success' => 'Cliente Editado com sucesso!', 'clients' => $client]);
            return $this->index();
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $model = new ClientModel();
            $deletedClient = $model->delete($id[0]);

            if (is_string($deletedClient)) {
                echo json_encode(['error' => $deletedClient]);
                return;
            }

            echo json_encode(['success' => 'Cliente deletado com sucesso!']);
            exit();
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function fetchClientsByType()
    {
        try {
            $type = $_POST['orderType'];

            $model = new ClientModel();
            $clients = $model->findByType($type);

            echo json_encode(['success' => 'Clientes encontrados', 'clients' => $clients]);
            exit();
        } catch (Exception $e) {
            return false;
        }
    }
}
