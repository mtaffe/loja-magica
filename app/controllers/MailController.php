<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require('vendor/autoload.php');
// // vendor\PHPMailer\src\Exception.php
// require_once __DIR__ .'\..\..\vendor\PHPMailer\src\PHPMailer.php';
// require_once __DIR__ .'\..\..\vendor\PHPMailer\src\SMTP.php';

class MailController extends RenderView
{
    private $authenticated;
    public $user;

    public function __construct()
    {
        $this->authenticated = isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ? 1 : 0;
        $user = new UserModel();
        $this->user = $user->fetchUserById($_SESSION['user_id']);
    }

    public function index()
    {
        $this->loadView('pages/partials/header', [
            "title" => "Envio de e-mails",
        ]);
        $this->loadView('pages/partials/sidebar', [
            "title" => "Envio de e-mails",
            'user' => $this->user
        ]);
        $this->loadView('pages/mail-form', []);
        $this->loadView('pages/partials/footer', []);
        return;
    }

    public function sendStatement()
    {
        try {
            $clients = new ClientModel();
            $clients = $clients->findAll();

            $subject = $_POST['subject'];
            $message = $_POST['message'];

            foreach ($clients as $client) {
                if (str_contains($client['email'], "@") && str_contains($client['email'], ".")) {
                    $this->sendMail($client['email'], $subject, $message);
                }
            }
            echo json_encode(['success' => "Emails enviados com sucesso!"]);
        } catch (Exception $e) {
            echo json_encode(['error' => "E-mai não enviado. Mailer Error: {$e->getMessage()}"]);
        }
    }

    public function orderStatusMail()
    {
        $clients = new ClientModel();
        $clients = $clients->findAll();

        $this->loadView('pages/partials/header', [
            "title" => "Envio de e-mails",
        ]);
        $this->loadView('pages/partials/sidebar', [
            "title" => "Envio de e-mails",
            'user' => $this->user
        ]);
        $this->loadView('pages/mail-form', ["clients" => $clients]);
        $this->loadView('pages/partials/footer', []);
        return;
    }

    public function sendOrderStatus()
    {
        try {
            $order = new OrderModel();
            $order = $order->updateStatus($_POST['orderId'], $_POST['orderStatus']);

            $client = new ClientModel();
            $client = $client->findOne($_POST['clientId']);
            
            if (!str_contains($client['email'], "@") || !str_contains($client['email'], ".")) {
                echo json_encode(['error' => "E-mail inválido"]);
                return;
            }
            if (!$this->sendMail('matheustaffe@hotmail.com', $_POST['subject'], $_POST['message'])) {
                echo json_encode(['error' => "E-mail não enviado"]);
                return;
            }

            echo json_encode(['success' => "Emails enviados com sucesso!", 'order' => $order]);
            exit;
        } catch (Exception $e) {
            echo json_encode(['error' => "E-mai não enviado. Mailer Error: {$e->getMessage()}"]);
        }
    }

    public function sendMail($email, $subject, $message)
    {
        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        $mail->Encoding = 'base64';
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = MAILHOST;
        $mail->Username = USERNAME;
        $mail->Password = PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom(SEND_FROM, SEND_FROM_NAME);
        $mail->addAddress($email);
        $mail->addReplyTo(REPLY_TO, REPLY_TO_NAME);
        $mail->IsHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AltBody = $message;

        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
}
