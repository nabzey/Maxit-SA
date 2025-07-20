<?php
namespace App\Core\Abstract;
use App\Core\Session;
use App\Config\ErrorMessage;
use App\Core\Validator;
abstract class AbstractController
{
    protected Session $session;
    protected ErrorMessage $errorMessage;
    protected Validator $validator;

    public function __construct()
    {
        $this->session = Session::getInstance();
    }
    abstract public function create();
    abstract public function edit($id);
    abstract public function index();
    abstract public function store($data = null);
    abstract public function destroy($id = null);
    abstract public function show($id = null);

    protected $layout = 'base.layout';
    public function renderHtml(string $view, array $params = [])
    {
        extract($params);
        ob_start();
        require dirname(__DIR__, 3) . '/templates/' . $view . '.php';
        $contentForLayout = ob_get_clean(); 
        require dirname(__DIR__, 3) . '/templates/layout/' . $this->layout . '.php';
    }
}