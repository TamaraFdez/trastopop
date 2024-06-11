<?php

namespace App\Controllers;

use Core\Authorization;
use Core\Database;
use Core\Session;
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
    function store()
    {
        //asegurar que llegan todos los campos requeridos o válidos
        $allowedFields = ['title', 'description', 'details', 'price', 'condition', 'category', 'tags', 'seller', 'address', 'city', 'state', 'phone', 'email'];
        $newTrastoData = array_intersect_key($_POST, array_flip($allowedFields));

        //Sanitizar los valores de todos los campos
        $newTrastoData = array_map('sanitize', $newTrastoData);
        //recorremos los campos requeridos y guardamos los errores si los hay
        $newTrastoData['user_id'] = Session::get('user')['id'];

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
        // Ruta de destino para guardar la imagen en la carpeta images
        $ruta_destino = basePath('public/images/' . $foto_nuevo_nombre);
        // inspectAndDie($ruta_destino);
        if (!move_uploaded_file($foto_temp, $ruta_destino)) {
            echo "Error al mover el archivo.";
            exit(); // Salir del script si hay un error al mover el archivo
        }
        $newTrastoData['imgurl'] = $foto_nuevo_nombre;
        $thumbImage = resizeImg($newTrastoData);
        $newTrastoData['thumbnail_imgurl'] = 'thumb' . $foto_nuevo_nombre;

        $requiredFields = ['title', 'description', 'city', 'email'];
        $errors = [];
        foreach ($requiredFields as $field) {
            if (empty($newTrastoData[$field]) || !Validation::string($newTrastoData[$field])) {
                $errors[$field] = "el campo no es válido";
            }
        }

        //si hay errore slos pasamos a la vista
        if ($errors) {
            loadView('/trastos/create', ['errors' => $errors, 'data' => $newTrastoData]);
        } else {

            $fields = [];
            //Convertir valores vacios a null 
            foreach ($newTrastoData as $field => $value) {
                $fields[] = '`' . $field . '`';
            }
            $fields = implode(', ', $fields);
            $values = [];
            foreach ($newTrastoData as $field => $value) {
                //pasar strings vacios a null
                if ($value === '') {
                    $newTrastoData[$field] = null;
                }
                $values[] = ':' . $field;
            }
            $values = implode(', ', $values);
            $query = "INSERT INTO trastos ($fields) VALUES ($values)";

            $this->db->query($query, $newTrastoData);
            Session::setFlashMessage('succes_message','Trasto añadido correctamente.' );
            redirect('/trastos');
        }

        //sino hay errores guardarmos el trasto
    }
    function delete($params)
    {

        $trasto = $this->db->query('SELECT * FROM trastos WHERE id = :id', $params)->fetch();



        if (!$trasto) {

            ErrorController::notFount('No se encuentra el trasto');
            return;
        }

        //comprobar si somos el autor
if(!Authorization::isOwner($trasto->user_id)){
    //TODO mostrar mensaje de error
    Session::setFlashMessage('error_message','No tienes autorización' );

    return redirect('/trasto/'.$trasto->id);
}

        $this->db->query('DELETE FROM trastos WHERE id = :id', $params);
     
        Session::setFlashMessage('succes_message','Trasto eliminado correctamente.' );
        redirect('/trastos');
    }
    function edit($params)
    {

        $trasto = $this->db->query('SELECT * FROM trastos WHERE id = :id', $params)->fetch();

        if (!$trasto) {

            ErrorController::notFount('No se encuentra el trasto');
            return;
        }
        if(!Authorization::isOwner($trasto->user_id)){
            //TODO mostrar mensaje de error
         
            Session::setFlashMessage('error_message','No tienes autorización' );
            return redirect('/trasto/'.$trasto->id);
        }


        loadView('trastos/edit', [
            'trasto' => $trasto
        ]);
    }
    function update($params)
    {

        //comprobar que el trasto para actualizar existe
        $trasto = $this->db->query('SELECT * FROM trastos WHERE id = :id', $params)->fetch();

        if (!$trasto) {
            //TODO crear el errorcontroller
            ErrorController::notFount('No se encuentra el trasto');
            return;
        }
        if(!Authorization::isOwner($trasto->user_id)){
            //TODO mostrar mensaje de error
            Session::setFlashMessage('error_message','No tienes autorización' );

            return redirect('/trasto/'.$trasto->id);
        }
        //asegurar que llegan todos los campos requeridos o válidos
        $allowedFields = ['title', 'description', 'details', 'price', 'condition', 'category', 'tags', 'seller', 'address', 'city', 'state', 'phone', 'email'];
        $updateTrastoData = array_intersect_key($_POST, array_flip($allowedFields));

        //Sanitizar los valores de todos los campos
        $updateTrastoData = array_map('sanitize', $updateTrastoData);
        //recorremos los campos requeridos y guardamos los errores si los hay


        //SUBIR LA IMAGEN A LA CARPETA Y GUARDAR LA RUTA
        //     if(isset($_FILES['foto'])){
        //     $foto_nombre = $_FILES['foto']['name']; // Nombre del archivo de la imagen
        //     $foto_temp = $_FILES['foto']['tmp_name']; // Ruta temporal del archivo de la imagen

        //     if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        //         echo "Error al subir el archivo.";
        //         exit(); // Salir del script si hay un error en la carga
        //     }

        //     // Obtener la extensión del archivo de la imagen
        //     $foto_extension = pathinfo($foto_nombre, PATHINFO_EXTENSION);
        //     // Generar un nombre único para la imagen
        //     $foto_nuevo_nombre = uniqid() . '.' . $foto_extension;
        //     // Ruta de destino para guardar la imagen en la carpeta images
        //     $ruta_destino = basePath('public/images/' . $foto_nuevo_nombre);
        //     // inspectAndDie($ruta_destino);
        //     if (!move_uploaded_file($foto_temp, $ruta_destino)) {
        //         echo "Error al mover el archivo.";
        //         exit(); // Salir del script si hay un error al mover el archivo
        //     }
        //     $updateTrastoData['imgurl'] = $foto_nuevo_nombre;
        //     $thumbImage = resizeImg($updateTrastoData);
        //     $updateTrastoData['thumbnail_imgurl'] = 'thumb'. $foto_nuevo_nombre;
        // }
        $requiredFields = ['title', 'description', 'city', 'email'];
        $updateTrastoData['id'] = $trasto->id;
        $errors = [];
        foreach ($requiredFields as $field) {
            if (empty($updateTrastoData[$field]) || !Validation::string($updateTrastoData[$field])) {
                $errors[$field] = "el campo no es válido";
            }
        }

        //si hay errore slos pasamos a la vista
        if ($errors) {

            loadView('/trastos/edit', ['errors' => $errors, 'trasto' => (object)$updateTrastoData]);
            exit;
        } else {

            $updateFields = [];
            //Convertir valores vacios a null 
            foreach ($updateTrastoData as $field => $value) {
                $updateFields[] = "`$field` = :$field";
            }
            $updateFields = implode(', ', $updateFields);
            $values = [];
            foreach ($updateTrastoData as $field => $value) {
                //pasar strings vacios a null
                if ($value === '') {
                    $updateTrastoData[$field] = null;
                }
                $values[] = ':' . $field;
            }
            $values = implode(', ', $values);
            $query = "UPDATE trastos SET $updateFields WHERE id = :id";
            

            $this->db->query($query, $updateTrastoData);
            Session::setFlashMessage('error_message','No tienes autorización' );

            redirect('/trasto/' . $params['id']);

            //sino hay errores guardarmos el trasto
        }
    }
}
