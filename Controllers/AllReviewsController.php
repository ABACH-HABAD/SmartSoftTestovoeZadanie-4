<?php

namespace Controllers;

include __DIR__ . '/Controller.php';
include __DIR__ . '/../Models/ReviewModel.php';

use Controllers\Controller;
use Models\ReviewModel;
use Users\User;
use Exception;
use Reviews\Review;

class AllReviewsController extends Controller
{
    /**
     * @var UserModel
     */
    protected $model;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->model = new ReviewModel();
    }

    /**
     * @return string
     */
    protected function Layout(): string
    {
        return $this->ReviewsList();
    }

    /**
     * @return string
     */
    private function ReviewsList(): string
    {
        $model = $this->model;
        $reviewsList = $model->GetAllReviews();
        if ($reviewsList == null) {
            $reviewsList = array();
            for ($i = 0; $i < 1; $i++) {
                $reviewsList[] = new Review("-", "-", 0);
            }
        }
        $stringifyReviewsList = array();
        for ($i = 0; $i < count($reviewsList); $i++) {
            $stringifyReviewsList[] = $this->ReviewListElement($reviewsList[$i]);
        }
        return $this->Template(__DIR__ . "/../Templates/AllReviews/AllReviewsLayout.php", array("reviews" => $stringifyReviewsList, "reviewForm" => $this->ReviewForm()));
    }

    /**
     * @param Review $review
     * @return string
     */
    private function ReviewListElement($review): string
    {
        return $this->Template(__DIR__ . "/../Templates/AllReviews/ReviewListElement.php", $review->ToArray());
    }

    /**
     * @return string
     */
    private function ReviewForm(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Index/form_create_review.html");
    }
}
