<?php

namespace Controllers;

include __DIR__ . '/Controller.php';
include __DIR__ . '/../Models/ReviewModel.php';
include __DIR__ . '/../Users/User.php';


use Models\ReviewModel;
use Models\UserModel;
use Controllers\Controller;
use Exception;

class UserController extends Controller
{

    /**
     * @return string
     */
    protected function Layout(): string
    {
        return $this->UserAuthorization() . $this->UserLogin() . $this->UserRegistration() . $this->UserData();
    }

    /**
     * @return string
     */
    protected function UserAuthorization(): string
    {
        return $this->Template(__DIR__ . "/../Templates/User/you_have_account.html");
    }

    /**
     * @return string
     */
    protected function UserLogin(): string
    {
        return $this->Template(__DIR__ . "/../Templates/User/email_login.html");
    }

    /**
     * @return string
     */
    protected function UserRegistration(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Index/form_registration.html");
    }

    /**
     * @return string
     */
    protected function UserData(): string
    {
        return $this->Template(__DIR__ . "/../Templates/User/UserLayout.php", array("userReview" => $this->UserReview(), "createReview" => $this->CreateReview()));
    }

    /**
     * @return string
     */
    protected function UserReview(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Index/ReviewListElement.php");
    }

    /**
     * @return string
     */
    protected function CreateReview(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Index/form_create_review.html");
    }

    /**
     * @return string
     */
    protected function UpdateData(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Index/form_registration.html");
    }
}
