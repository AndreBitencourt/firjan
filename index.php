<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];

$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

if (empty($path) || !isset($path[0])) {
    http_response_code(400);
    echo json_encode(['error' => 'Rota inválida ou não especificada']);
}

$file = './services/Database.php';

if (!file_exists($file)) {
    http_response_code(400);
    echo json_encode(['error' => 'Arquivo de configuração não encontrado.']);
    exit;
}

require_once $file;

$db = (new Database())->connect();

$router = $path[0];
$id = $path[1] ?? null;

$input = file_get_contents('php://input');

$data = json_decode($input, true);

try {
    switch ($router) {
        case 'unidades':
            require_once './controllers/UnidadeController.php';
            $controller = new UnidadeController($db);
            handleRequest($controller, $method, $id, $data);
            break;

        case 'cursos':
            require_once './controllers/CursoController.php';
            $controller = new CursoController($db);
            handleRequest($controller, $method, $id, $data);
            break;

        case 'turmas':
            require_once './controllers/TurmaController.php';
            $controller = new TurmaController($db);
            handleRequest($controller, $method, $id, $data);
            break;

        case 'alunos':
            require_once './controllers/AlunoController.php';
            $controller = new AlunoController($db);
            handleRequest($controller, $method, $id, $data);
            break;

        case 'alunos-unidade':
            require_once './controllers/AlunoUnidadesController.php';
            $controller = new AlunoUnidadesController($db);
            handleRequest($controller, $method, $id, $data);
            break;
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Rota não encontrada']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}


function handleRequest($controller, $method, $id, $data)
{
    switch ($method) {
        case 'GET':
            if ($id) {
                $controller->getById($id);
            } else {
                $controller->getAll();
            }
            break;

        case 'POST':
            $controller->create($data);
            break;

        case 'PUT':
            if (!$id) {
                http_response_code(400);
                echo json_encode(['error' => 'ID é obrigatório para atualizar']);
                break;
            }
            $controller->update($id, $data);
            break;

        case 'DELETE':
            if (!$id) {
                http_response_code(400);
                echo json_encode(['error' => 'ID é obrigatório para excluir']);
                break;
            }
            $controller->delete($id);
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido']);
            break;
    }
}
