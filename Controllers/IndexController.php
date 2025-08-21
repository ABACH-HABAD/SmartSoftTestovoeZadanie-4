<?php

namespace Controllers;

include __DIR__ . '/Controller.php';
include __DIR__ . '/../Models/ReviewModel.php';

use Controllers\Controller;
use Exception;
use Models\ReviewModel;
use Reviews\Review;

class IndexController extends Controller
{
    /**
     * @var ReviewModel
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
        return $this->FormRegistration() . $this->FormOrder() . $this->ReviewList() . $this->Scripts();
    }

    /**
     * @return string
     */
    private function FormRegistration(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Index/form_registration.html");
    }

    /**
     * @return string
     */
    private function FormOrder(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Index/form_order.html");
    }

    /**
     * @return string
     */
    private function ReviewList(): string
    {
        $model = $this->model;
        $reviewsList = $model->GetReviews();
        if ($reviewsList == null) {
            $reviewsList = array();
            for ($i = 0; $i < 6; $i++) {
                $reviewsList[] = new Review("Ошикба", "Неудалось загрузить отзыв");
            }
        }
        $stringifyReviewsList = array();
        for ($i = 0; $i < count($reviewsList); $i++) {
            $stringifyReviewsList[] = $this->ReviewListElement($reviewsList[$i]);
        }
        return $this->Template(__DIR__ . "/../Templates/Index/ReviewsList.php", array("formCreateReview" => $this->FromCreateReview(), "reviews" => $stringifyReviewsList));
    }

    /**
     * @param Review $review
     * @return string
     */
    private function ReviewListElement($review): string
    {
        return $this->Template(__DIR__ . "/../Templates/Index/ReviewListElement.php", $review->ToArray());
    }

    /**
     * @return string
     */
    private function FromCreateReview(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Index/form_create_review.html");
    }

    /**
     * @return string
     */
    private function Scripts(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Index/scripts.html");
    }
}
