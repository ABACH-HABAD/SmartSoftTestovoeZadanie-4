<?php

header('Content-Type: application/json; charset=utf-8');

include __DIR__ . '/../Models/UserModel.php';

use Models\UserModel;

try {
    $input = json_decode(file_get_contents('php://input'), true);

    $model = new UserModel();
    $model->DeleteUserInDataBase($input['id']);

    echo json_encode([
        'success' => true,
        'message' => 'Пользователь успешно удалён'
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
