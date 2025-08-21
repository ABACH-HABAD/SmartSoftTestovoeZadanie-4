<?php

header('Content-Type: application/json; charset=utf-8');

include __DIR__ . '/../Models/UserModel.php';

use Models\UserModel;

try {
    $id = $_GET['id'];

    $model = new UserModel();
    $foundUser = $model->FindByID($id);

    if ($foundUser == null) {
        throw new Exception("Пользователь не найден");
    }

    echo json_encode([
        'success' => true,
        'message' => 'Пользователь успешно зарегестрирован',
        'name' => $foundUser->getName(),
        'surname' => $foundUser->getSurname(),
        'email' => $foundUser->getEmail(),
        'message' => $foundUser->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
