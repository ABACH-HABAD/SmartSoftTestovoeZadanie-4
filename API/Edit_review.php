<?php

header('Content-Type: application/json; charset=utf-8');

include __DIR__ . '/../Models/ReviewModel.php';

use Models\ReviewModel;

try {
    $input = json_decode(file_get_contents('php://input'), true);

    $model = new ReviewModel();
    $model->ChangeReviewInDataBase($input['id'], $input['comment']);

    echo json_encode([
        'success' => true,
        'message' => 'Отзыв успешно изменён'
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
