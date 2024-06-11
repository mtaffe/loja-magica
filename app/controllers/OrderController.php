<?php

require('vendor/autoload.php');


class OrderController extends RenderView
{
    private $authenticated;

    public function __construct()
    {
        $this->authenticated = isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ? 1 : 0;
    }


    public function index()
    {
        $auth = $this->authenticated;

        $user = new UserModel();
        $user = $user->fetchUserById(isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0);

        $model = new OrderModel();

        $orders = $model->findAllWithClient();

        $this->loadView('pages/partials/header', [
            "title" => "Lista de Pedidos",
        ]);
        $this->loadView('pages/partials/sidebar', [
            "title" => "Lista de Pedidos",
            'isAuth' => $auth,
            'user' => $user
        ]);
        $this->loadView('pages/orders', ['orders' => $orders]);
        $this->loadView('pages/partials/footer', []);
    }

    public function create()
    {
        $auth = $this->authenticated;

        $user = new UserModel();
        $user = $user->fetchUserById(isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0);

        $model = new ClientModel();
        $clients = $model->findAll();

        $this->loadView('pages/partials/header', [
            "title" => "Criar Pedido",
        ]);
        $this->loadView('pages/partials/sidebar', [
            "title" => "Criar Pedido",
            'isAuth' => $auth,
            'user' => $user
        ]);
        $this->loadView('pages/order-form', ['clients' => $clients]);
        $this->loadView('pages/partials/footer', []);
    }

    public function store()
    {
        try {
            $model = new OrderModel();

            $order = $_POST;
            $order = $model->create($order['client_id'], $order['product'], $order['quantity'], 'Criado');

            echo json_encode(['success' => 'Pedido cadastrado com sucesso!', 'order' => $order]);
            exit();
        } catch (Exception $e) {
            return false;
        }
    }

    public function edit($id)
    {
        $auth = $this->authenticated;

        $user = new UserModel();
        $user = $user->fetchUserById($_SESSION['user_id']);

        $model = new OrderModel();
        $order = $model->orderWithClient($id[0]);

        $clientModel = new ClientModel();
        $clients = $clientModel->findAll();

        $this->loadView('pages/partials/header', [
            "title" => "Editar Pedido",
        ]);
        $this->loadView('pages/partials/sidebar', [
            "title" => "Editar Pedido",
            'isAuth' => $auth,
            'user' => $user
        ]);
        $this->loadView('pages/order-form', ['order' => $order, 'clients' => $clients]);
        $this->loadView('pages/partials/footer', []);
    }

    public function update($id)
    {
        try {
            $model = new OrderModel();

            $order = $_POST;
            $order = $model->update($id[0], $order['client_id'], $order['product'], $order['quantity'], $order['status']);

            echo json_encode(['success' => 'Pedido atualizado com sucesso!', 'order' => $order]);
            exit();
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $model = new OrderModel();
            $deltedOrder = $model->delete($id[0]);

            if (is_string($deltedOrder)) {
                echo json_encode(['error' => $deltedOrder]);
                return;
            }

            echo json_encode(['success' => 'Pedido excluido com sucesso!']);
            exit();
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
            exit();
        }
    }

    public function orderByClient($id)
    {
        try {
            $model = new OrderModel();
            $orders = $model->findByClient($id[0]);
            echo json_encode(['success' => 'Pedidos encontrados', 'orders' => $orders]);
        } catch (Exception $e) {
            return false;
        }
    }
}
