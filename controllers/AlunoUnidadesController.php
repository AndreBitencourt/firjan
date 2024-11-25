<?php

$file = '/models/AlunosUnidades.php';

if (file_exists($_SERVER['DOCUMENT_ROOT'] . $file)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . $file;
} else {
    echo "O arquivo não foi encontrado: $file";
}

class AlunoUnidadesController{
    private $model;
    
    public function __construct($db){
        $this->model = new AlunosUnidades($db);
    }
    
    public function getAll(){
        
    }
    
    public function getByUnity($id){
        
    }
    
}