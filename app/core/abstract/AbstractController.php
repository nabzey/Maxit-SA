<?php
namespace App\Core\Abstract;

abstract class AbstractController
{
    abstract public function index();
    abstract public function store();
    
    abstract public function destroy();
    abstract public function show();
    abstract public function edit();

    public function create()
    {
        $this->renderHtml('register.html.php');
    }
  protected function renderHtml(string $view)
{
    ob_start();
       $viewPath = dirname(__DIR__, 3) . '/templates/' . $view;
    if (!file_exists($viewPath)) {
        throw new \Exception("Vue introuvable : $viewPath");
    }

    require_once $viewPath;

    $contentForLayout = ob_get_clean();

require_once dirname(__DIR__, 3) . '/templates/layout/base.layout.php';
}

}