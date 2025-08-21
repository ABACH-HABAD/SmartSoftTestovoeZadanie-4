<?php

header('Content-Type: application/json; charset=utf-8');

include __DIR__ . '/../Models/ReviewModel.php';

use Models\ReviewModel;

try {
    $id = $_GET['id'];

    $model = new ReviewModel();
    $foundReview = $model->FindReviewByUserID($id);

    if ($foundReview == null) {
        throw new Exception("Отзыв не найден");
    }

    echo json_encode([
        'success' => true,
        'message' => 'Отзыв найден в базе данных',
        'name' => $foundReview->getName(),
        'comment' => $foundReview->getComment()
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
