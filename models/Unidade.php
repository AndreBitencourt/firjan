<?php

$file = '/models/BaseModel.php';

if (file_exists($_SERVER['DOCUMENT_ROOT'] . $file)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . $file;
} else {
    echo "O arquivo não foi encontrado: $file";
}

class Unidade extends BaseModel
{
    public function __construct($conn)
    {
        parent::__construct($conn, 'firjan_unidades');
    }
}
