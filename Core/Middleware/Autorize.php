<?php 

namespace Core\Middleware;

use Core\Session;

class Autorize{
    function isAutenticated(){
        return Session::has('user');
    }
    function handle($role){
        if($role === 'guest' && $this->isAutenticated()){
            return redirect('/');
        }else if($role == 'auth' && !$this->isAutenticated()){
            return redirect('auth/login');
        }
    }
}