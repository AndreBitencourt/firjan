<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/services/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/UnidadeController.php';

$db = (new Database())->connect();
$controller = new UnidadeController($db);

$method = $_SERVER['REQUEST_METHOD'];

$request_uri = $_SERVER['REQUEST_URI'];

$path = explode('/', trim($request_uri, '/'));

if ($path[0] === 'unidades') {
    switch ($method) {
        case 'GET':
            if (isset($path[1])) {
                $controller->getById($path[1]);
            } else {
                $controller->getAll();
            }
            break;
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            $controller->create($data);
            break;
        case 'PUT':
            $data = json_decode(file_get_contents('php://input'), true);
            $controller->update($path[1], $data);
            break;
        case 'DELETE':
            $controller->delete($path[1]);
            break;
        default:
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
            break;
    }
}
