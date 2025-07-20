<?php

namespace App\Core\Middlewares;

class Auth
{
    public function __invoke(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit();
        }

        if (!isset($_SESSION['user']['id']) || empty($_SESSION['user']['id'])) {
            session_destroy();
            header('Location: /');
            exit();
        }

        $this->validateUserStatus();
    }

    private function validateUserStatus(): void
    {
        try {
            if (isset($_SESSION['user']['statut_compte']) && 
                $_SESSION['user']['statut_compte'] !== 'ACTIF') {
                
                session_destroy();
                header('Location: /?error=compte_inactif');
                exit();
            }
        } catch (\Exception $e) {
            error_log("Erreur validation statut utilisateur: " . $e->getMessage());
        }
    }
}