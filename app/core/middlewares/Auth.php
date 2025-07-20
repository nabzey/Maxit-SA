

// namespace App\Core\middlewares;

class Auth 

    public function __invoke()
    {
       if(session_statu()===PHP_SESSION_NONE) 
       session_start();
    }



