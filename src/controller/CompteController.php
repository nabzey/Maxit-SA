<?php
namespace App\Controller;

use App\Core\Abstract\AbstractController;
use App\Service\CompteService;
use App\Core\Session;

class CompteController extends AbstractController {
    private CompteService $compteService;
    protected Session $session;

    public function __construct(?CompteService $compteService = null, $session = null) {
        parent::__construct($session);
        $this->compteService = $compteService ?? \App\Core\App::getDependency('compteService');
    }

    public function afficherSolde() {
        $user = $this->session->get('user');
        $solde = 0;
        if ($user && isset($user['id'])) {
            $solde = $this->compteService->getSoldeByPersonneId($user['id']);
        }
        
        echo $this->renderHtml('compte/acceuil', ['solde' => $solde]);
    }
   
    public function Secondaire() {

        echo $this->renderHtml('compte/secondaire');     
}
//       public function retour() {
//        $this->renderHtml('compte/acceuil');  
// }



 public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $personne = $this->session->get('user');
            $personneId = $personne['id'];
            $solde = (float) ($_POST['solde'] ?? 0);
            $telephone = $_POST['telephone'] ?? '';

            $insert = $this->compteService->CompteSecondaire($personneId, $telephone, $solde );
            // Récupérer tous les comptes après ajout
            $comptes = $this->compteService->getComptesByPersonneId($personneId);
            echo $this->renderHtml('compte/acceuil', [
                'comptes' => $comptes,
                'success' => $insert ? true : false
            ]);
            return;
        }
        $this->renderHtml('compte/acceuil');  
    }

     public function edit($id){}
     public function index(){}
     public function store($data = null){}
     public function destroy($id = null){}
     public function show($id = null){}

}