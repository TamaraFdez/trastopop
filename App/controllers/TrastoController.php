<?php

namespace App\Controllers;

use Core\Database;
use Core\Validation;

class TrastoController
{
    protected $db;

    function __construct()
    {

        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }
    function index()
    {
        $trastos = $this->db->query('SELECT * FROM trastos')->fetchAll();


        //Llamar al modelo para obtener los datos

        // Pasarlos a la vista home y cargar la vista

        loadView('trastos/index', [
            'trastos' => $trastos
        ]);
    }
    function show($params)
    {


        $trasto = $this->db->query('SELECT * FROM trastos WHERE id = :id', $params)->fetch();

        if (!$trasto) {
            //TODO crear el errorcontroller
            ErrorController::notFount('No se encuentra el trasto');
            return;
        }
        loadView('trastos/show', [
            'trasto' => $trasto
        ]);
    }
    function create()
    {
        loadView('trastos/create');
    }
    function store(){
        //asegurar que llegan todos los campos requeridos o válidos
        $allowedFields = ['title','description', 'details', 'price','condition', 'category', 'tags', 'seller', 'address', 'city', 'state', 'phone', 'email'];
        $newTrastoData = array_intersect_key($_POST,array_flip($allowedFields));

        //Sanitizar los valores de todos los campos
        $newTrastoData = array_map('sanitize',$newTrastoData);
        //recorremos los campos requeridos y guardamos los errores si los hay
        $newTrastoData['user_id'] = 2;//fake logged user
       
        //SUBIR LA IMAGEN A LA CARPETA Y GUARDAR LA RUTA
        $foto_nombre = $_FILES['foto']['name']; // Nombre del archivo de la imagen
        $foto_temp = $_FILES['foto']['tmp_name']; // Ruta temporal del archivo de la imagen

        if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            echo "Error al subir el archivo.";
            exit(); // Salir del script si hay un error en la carga
        }

        // Obtener la extensión del archivo de la imagen
        $foto_extension = pathinfo($foto_nombre, PATHINFO_EXTENSION);
        // Generar un nombre único para la imagen
        $foto_nuevo_nombre = uniqid() . '.' . $foto_extension;
        // Ruta de destino para guardar la imagen en la carpeta img_perfil
        $ruta_destino = basePath('public/images/' . $foto_nuevo_nombre); 
        // inspectAndDie($ruta_destino);
         if (!move_uploaded_file($foto_temp, $ruta_destino)) {
            echo "Error al mover el archivo.";
            exit(); // Salir del script si hay un error al mover el archivo
        }
        $newTrastoData['imgurl'] = $foto_nuevo_nombre;

        $requiredFields = ['title','description','city','email'];
        $errors = [];
        foreach($requiredFields as $field){
            if(empty($newTrastoData[$field]) || !Validation::string($newTrastoData[$field])){
                $errors[$field] = "el campo no es válido";
            }
        }
        
        //si hay errore slos pasamos a la vista
        if($errors){
            loadView('/trastos/create', ['errors' => $errors, 'data'=> $newTrastoData]);
        }else{

            $fields = [];
            //Convertir valores vacios a null 
            foreach($newTrastoData as $field => $value){
                $fields[] = '`'.$field.'`';
            }
            $fields = implode(', ', $fields);
            $values =[];
            foreach($newTrastoData as $field => $value){
                //pasar strings vacios a null
                if($value=== ''){
                    $newTrastoData[$field] = null;
                }
                $values[]= ':'.$field;
            }
            $values = implode(', ', $values);
            $query = "INSERT INTO trastos ($fields) VALUES ($values)";
          
            $this->db->query($query, $newTrastoData);

            redirect('/trastos');

        }

        //sino hay errores guardarmos el trasto
    }
}
