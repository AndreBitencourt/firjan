<?php

$file = '/models/Cursos.php';

if (file_exists($_SERVER['DOCUMENT_ROOT'] . $file)) {
    require_once $_SERVER['DOCUMENT_ROOT'] . $file;
} else {
    echo "O arquivo não foi encontrado: $file";
}

class CursoController {
    private $model;

    public function __construct($db) {
        $this->model = new Curso($db);
    }

    public function getAll() {
        echo json_encode($this->model->getAll());
    }

    public function getById($id) {
        echo json_encode($this->model->getById($id));
    }

    public function create($data) {
        echo json_encode(['success' => $this->model->create($data)]);
    }

    public function update($id, $data) {
        echo json_encode(['success' => $this->model->update($id, $data)]);
    }

    public function delete($id) {
        echo json_encode(['success' => $this->model->delete($id)]);
    }
}

?>