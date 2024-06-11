<?php

namespace App\Controllers;

use Core\Database;
use Core\Validation;
use Core\Session;

class UserController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    function login()
    {
        loadView('users/login');
    }
    function create()
    {
        loadView('users/create');
    }
    function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];

        $errors = [];

        if (!Validation::string($name, 2, 50)) {
            $errors['name'] = "El nombre debe tener entre 2 y 50 carácteres";
        }
        if (!Validation::email($email)) {
            $errors['email'] = "Escribe un email válido";
        }
        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = "La contraseña debe tener entre 6 y 50 carácteres";
        }
        if (!Validation::match($password, $password_confirmation)) {
            $errors['passwords'] = "Las contraseñas no coinciden";
        }
        if (!empty($errors)) {
            loadView('users/create', [
                'errors' => $errors,
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state
                ]]);
            exit;
        }

        //Mirar si ya existe un email
        $params = [
            'email' => $email
        ];
        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if ($user) {
            $errors['email'] = "El email ya esta registrado";
            loadView('users/create', [
                'errors' => $errors,
                'user' => [
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state
                ]
            ]);
            exit;
        }
        $params = [
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        // inspectAndDie($params);
        $this->db->query('INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)', $params);
       

        redirect('/auth/login');
    }
    function logout(){
        Session::clearAll();

        $params = session_get_cookie_params();
        setcookie('PHPSESSIN','', time() - 1, $params['path'], $params['domain']);
        redirect('/');
    }
    function authenticate(){
       
        $email = $_POST['email'];
       
        $password = $_POST['password'];
       

        $errors = [];

        
        if (!Validation::email($email)) {
            $errors['email'] = "Escribe un email válido";
        }
       
        if (!empty($errors)) {
            loadView('users/login', [
                'errors' => $errors,
            ]);
            exit;
        }

        //Mirar si ya existe el email y si es asi comprobamos el password
   
        $params = [
            'email' => $email
        ];
        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if (!$user) {
            $errors['email'] = "Credenciales no válidas";
            loadView('users/login', [
                'errors' => $errors,
                'user' => [
                    'email' => $email
                ] 
            ]);
            exit;
        }
     //Si coincide iniciamos session sinó mostramos la vista login
     if(!password_verify($password, $user->password)){
        $errors['email'] = "Credenciales no válidas";
        loadView('users/login', [
            'errors' => $errors,
            'user' => [
                'email' => $email
            ]
         
        ]);
        exit;
     }

    Session::set('user', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'city' => $user->city,
            'state' => $user->state

        ]);
        redirect('/');
    }
}
