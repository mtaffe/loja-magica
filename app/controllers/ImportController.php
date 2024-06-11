<?php

require('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ImportController extends RenderView
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
        $user = $user->fetchUserById($_SESSION['user_id']);
        
        $model = new ClientModel();

        $this->loadView('pages/partials/header', [
            "title" => "Importar Arquivo",
        ]);
        $this->loadView('pages/partials/sidebar', [
            "title" => "Importar Arquivo",
            'isAuth' => $auth,
            'user' => $user
          ]);
        $this->loadView('pages/import', []);
        $this->loadView('pages/partials/footer', []);
    }

    public function import()
    {
        if (isset($_FILES['file'])) {
            if (str_ends_with($_FILES['file']['name'], '.xlsx')) {
                return $this->storeExcel($_FILES['file']['tmp_name']);
            }

            if (str_ends_with($_FILES['file']['name'], '.xml')) {
                return $this->storeXML($_FILES['file']['tmp_name']);
            }
        }
    }

    public function storeExcel($file)
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $keys = $sheetData[0];
        $keys = $this->formatKeys($keys);
        unset($sheetData[0]);

        $rows = [];

        $model = new ClientModel();
        $orderModel = new OrderModel();

        foreach ($sheetData as $row) {
            $data = array_combine($keys, $row);
            array_push($rows, $data);
            $client = $model->create($data['nome'], $data['e-mail'], 'Cliente Individual', $data['data-ultimo-pedido'], $data['valor-ultimo-pedido']);

            if (str_contains(';', $data['historico-de-pedidos'])) {
                $orderHistory = explode(';', $data['historico-de-pedidos']);
                foreach ($orderHistory as $order) {
                    $orderModel->create($client['id'], $order, null, 'Entregue');
                }
            }

            $orderModel->create($client['id'], $data['historico-de-pedidos'], null, "Entregue");
        }

        echo json_encode(['success' => 'Planilha importada com sucesso']);
        exit();
    }

    public function storeXML($file)
    {
        try {
            $xml = simplexml_load_file($file);
            $model = new ClientModel();
            $orderModel = new OrderModel();

            foreach ($xml as $order) {
                $client = $model->checkClientExists($order->nome_loja);
                if ($client == false) {
                    $client =  $model->create($order->nome_loja, $order->nome_loja, $order->localizacao, 'Loja', '', '');
                }
                $orderModel->create($client['id'], $order->produto, $order->quantidade, "Criado");
            }

            echo json_encode(['success' => "Dados importados com sucesso!"]);
            exit();
        } catch (Exception $e) {
            echo json_encode($e->getMessage());
        }
    }

    public function formatKeys(array $keys)
    {
        $newKeys = [];
        foreach ($keys as $key) {
            $string = str_replace(' ', '-', $key);
            $string = preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
            $string = strtolower($string);
            $string = preg_replace('/-+/', '-', $string);
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
            $string = rtrim($string, '-');


            array_push($newKeys, $string);
        }

        return $newKeys;
    }
}
