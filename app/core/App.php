<?php

namespace App\Core;
use App\Core\Database;
use App\Core\Session;
use App\Core\Validator;
use App\Core\Router;
use App\Repository\PersonneRepository;
use App\Service\PersonneService;
use App\Repository\CompteRepository;
use App\Service\CompteService;
use App\Controller\CompteController;
use App\Controller\PersonneController;
use App\Repository\TransactionRepository;
use App\Service\TransactionService;


class App{
    private static array $dependencies = [];

    public static function initDependencies(): void {
      $personneRepository = new PersonneRepository();
      $compteRepository = new CompteRepository();
      $transactionRepository = new TransactionRepository();
      $personneService = new PersonneService($personneRepository, $compteRepository);
      $compteService = new CompteService($compteRepository);
      $transactionService = new TransactionService($transactionRepository);
      $personneController = new PersonneController($personneService, $transactionService);
      $compteController= new CompteController($compteService);

        self::$dependencies = [
            "core" => [
              'router' => new Router(),
              'database'=>Database::getInstance(),
              'session'=> Session::getInstance(),
              'validator'=>new Validator()                    
            ],
            "repository" => [
               'personneRepository'=> $personneRepository,
               'compteRepository'=> $compteRepository,
               'transactionRepository'=> $transactionRepository
            ],
            "service" => [
                'compteService'=> $compteService,
                'personneService'=> $personneService,
                'transactionService'=> $transactionService
            ],
            "controller" => [
                'personneController'=>$personneController,
                'compteController' =>$compteController,
            ]
        ];
    }

    public static function getDependency(string $key){
        foreach (self::$dependencies as $group) {
            if (array_key_exists($key, $group)) {
                return $group[$key];
            }
        }
        throw new \Exception("Dependency not found: " . $key);
    }
}
//static appele directement class  sans objet