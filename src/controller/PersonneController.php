<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;
use App\Core\Session;
use App\Service\PersonneService;
use App\Core\App;
use App\Service\TransactionService;
use App\Config\ErrorMessage;

class PersonneController extends AbstractController
{
    private PersonneService $personneService;
    private TransactionService $transactionService;

    public function __construct(?PersonneService $personneService = null, ?TransactionService $transactionService = null)
    {
        parent::__construct();
        $this->personneService = $personneService ?? App::getDependency('personneService');
        $this->transactionService = $transactionService ?? App::getDependency('transactionService');
        $this->session = Session::getInstance();
    }

    public function login()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($login)) {
                $errors['login'][] = ErrorMessage::isValide;
            }

            if (empty($password)) {
                $errors['password'][] = ErrorMessage::invalidPassword;
            }

            if (empty($errors)) {
                $personne = $this->personneService->findPersonne($login, $password);

                if ($personne) {
                    $this->session->set('user', $personne->toArray());
                    header('Location: /acceuil');
                    exit;
                } else {
                    $errors['login'][] = ErrorMessage::invalideIdentifiant;
                }
            }

            echo $this->renderHtml('login/login', ['errors' => $errors]);
            return;
        }

        echo $this->renderHtml('login/login');
    }

    public function afficher()
    {
        $user = $this->session->get('user');
        if (!$user || !isset($user['id'])) {
            header('Location: /login');
            exit;
        }

        $transactions = [];
        $compteService = App::getDependency('compteService');
        $solde = $compteService->getSoldeByPersonneId($user['id']);
        $compte = $compteService->getCompteByPersonneId($user['id']);

        if ($compte && isset($compte['id'])) {
            $transactions = $this->transactionService->getTransaction($compte['id']);
        }

        echo $this->renderHtml('compte/acceuil', [
            'solde' => $solde,
            'transactions' => $transactions
        ]);
    }

    public function create()
    {
        $validator = \App\Core\Validator::getInstance();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'] ?? '',
                'prenom' => $_POST['prenom'] ?? '',
                'telephone' => $_POST['telephone'] ?? '',
                'numerocni' => $_POST['numerocni'] ?? '',
                'adresse' => $_POST['adresse'] ?? '',
                'typepersonne' => 'client',
                'login' => $_POST['login'] ?? '',
                'password' => $_POST['password'] ?? '',
                'photorecto' => $_FILES['photorecto'] ?? null,
                'photoverso' => $_FILES['photoverso'] ?? null
            ];

            $rules = [
                'nom' => ['required', ['minLength', 2]],
                'prenom' => ['required', ['minLength', 2]],
                'telephone' => ['required', 'isSenegalPhone'],
                'numerocni' => ['required', 'isCNI'],
                'adresse' => ['required', ['minLength', 5]],
                'typepersonne' => ['required'],
                'login' => ['required', ['minLength', 3]],
                'password' => ['required', 'isPassword'],
                'photorecto' => ['required'],
                'photoverso' => ['required']
            ];

            $validator->validate($data, $rules);
            $errors = $validator::getErrors();

            $result = $this->personneService->enregistrerPersonne($data);
            if ($result['success']) {
                $this->session->set('user', $result['personne']->toArray());
                header('Location: /choisir-compte');
                exit;
            } else {
                $errors['global'][] = $result['errors']['global'][0] ?? ErrorMessage::accountCreationError;
            }

            echo $this->renderHtml('login/register', ['errors' => $errors, 'old' => $_POST]);
            return;
        }

        echo $this->renderHtml('login/register');
    }

    public function choisirCompte()
    {
        $user = $this->session->get('user');
        if (!$user || !isset($user['id'])) {
            header('Location: /login');
            exit;
        }

        $compteService = App::getDependency('compteService');
        $comptes = $compteService->getComptesByPersonneId($user['id']);

        echo $this->renderHtml('compte/choisir_compte', [
            'comptes' => $comptes
        ]);
    }

    public function activerCompte()
    {
        $user = $this->session->get('user');
        $compteId = $_POST['compte_id'] ?? null;

        if ($user && $compteId) {
            try {
                $compteService = App::getDependency('compteService');
                $compteService->changerComptePrincipal($user['id'], (int)$compteId);

                header('Location: /acceuil');
                exit;
            } catch (\Exception $e) {
                echo $this->renderHtml('compte/choisir_compte', [
                    'error' => 'Erreur lors du changement de compte principal.'
                ]);
            }
        }
    }

    public function changerComptePrincipal()
    {
        $user = $this->session->get('user');
        $nouveauCompteId = $_POST['compte_id'] ?? null;

        if ($user && $nouveauCompteId) {
            try {
                $compteService = App::getDependency('compteService');
                $compteService->changerComptePrincipal($user['id'], (int)$nouveauCompteId);

                header('Location: /mes-comptes');
                exit;
            } catch (\Exception $e) {
                echo $this->renderHtml('compte/mes_comptes', [
                    'error' => 'Impossible de changer le compte principal.'
                ]);
            }
        }
    }

    public function lister()
    {
        $user = $this->session->get('user');
        $transactions = [];

        if ($user && isset($user['id'])) {
            $compteService = App::getDependency('compteService');
            $comptes = $compteService->getComptesByPersonneId($user['id']);

            if ($comptes) {
                foreach ($comptes as $compte) {
                    $trs = $this->transactionService->getTransaction($compte['id']);
                    if ($trs) {
                        $transactions = array_merge($transactions, $trs);
                    }
                }
            }
        }

        echo $this->renderHtml('compte/transactions', ['transactions' => $transactions]);
    }

    public function deconnexion()
    {
        $this->session->destroy();
        header('Location: /');
        exit;
    }

    public function index()
    {
        echo $this->renderHtml('login/login');
    }

    public function edit($id) {}
    public function destroy($id = null) {}
    public function show($id = null) {}
    public function store($data = null)
    {
        if ($data === null) {
            $data = $_POST;
        }

        $result = $this->personneService->enregistrerPersonne($data);
        if ($result['success']) {
            header('Location: /login');
            exit;
        } else {
            echo $this->renderHtml('login/register', ['errors' => [$result['message'] ?? \App\Config\ErrorMessage::required->value], 'old' => $data]);
        }
    }
}
