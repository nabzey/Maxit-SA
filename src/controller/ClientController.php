<?php
namespace App\Controller;
use App\Core\abstract\AbstractController;
use App\Service\ClientService;

use App\Core\Session;

class ClientController extends AbstractController
{
    private ClientService $clientService;
    private Session $session;

    public function __construct()
    {
        $pdo = new \PDO('pgsql:host=localhost;dbname=Postgres', 'postgres', 'Diamniadio14@');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->clientService = new ClientService($pdo);
        $this->session = new Session(); 
    }
  public function index()
{
    $this->renderHtml('acceuil.html.php');
}
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->renderHtml('login.html.php');
            return;
        }

        $telephone = $_POST['telephone'] ?? null;

        if (!$telephone) {
            $this->renderHtml('login.html.php', ['error' => 'Veuillez entrer un numéro de téléphone']);
            return;
        }

        $user = $this->clientService->findByTelephone($telephone);

        if ($user) {
            $this->session->set('user', $user);
            header('Location: /home');
            exit;
        } else {
            $this->renderHtml('login.html.php', ['error' => 'Numéro de téléphone inconnu']);
        }
    }

   public function create(): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $result = $this->clientService->registerClient($_POST, $_FILES);

        if ($result['success']) {
            header('Location: /login');
            exit;
        } else {
            // En cas d’erreur (ex: téléphone déjà pris), réaffiche le formulaire avec message
            $this->renderHtml('register.html.php', ['error' => $result['message'], 'old' => $_POST]);
            return;
        }
    }

    // Affiche le formulaire (GET)
    $this->renderHtml('register.html.php');
}
public function dashboard()
{
    if (!$this->session->has('user')) {
        header('Location: /login');
        exit;
    }

    $this->renderHtml('home.html.php', [
        'user' => $this->session->get('user')
    ]);
}

    public function logout()
    {
        $this->session->destroy();
        header('Location: /');
        exit;
    }

    public function store() {}
    public function destroy() {}
    public function show() {}
    public function edit() {}
}
