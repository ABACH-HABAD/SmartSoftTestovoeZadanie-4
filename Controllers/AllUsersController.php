<?php

namespace Controllers;

include __DIR__ . '/Controller.php';
include __DIR__ . '/../Models/UserModel.php';

use Controllers\Controller;
use Models\UserModel;
use Users\User;
use Exception;

class AllUsersController extends Controller
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
        $this->model = new UserModel();
    }

    /**
     * @return string
     */
    protected function Layout(): string
    {
        return $this->UsersList();
    }

    /**
     * @return string
     */
    private function UsersList(): string
    {
        $model = $this->model;
        $usersList = $model->GetAllUsers();
        if ($usersList == null) {
            $usersList = array();
            for ($i = 0; $i < 1; $i++) {
                $usersList[] = new User(-1, "-", "-", "-", "-");
            }
        }
        $stringifyUsersList = array();
        for ($i = 0; $i < count($usersList); $i++) {
            $stringifyUsersList[] = $this->UserListElement($usersList[$i]);
        }
        return $this->Template(__DIR__ . "/../Templates/AllUsers/AllUsersLayout.php", array("users" => $stringifyUsersList, "userForm" => $this->UserForm()));
    }

    /**
     * @param User $user
     * @return string
     */
    private function UserListElement($user): string
    {
        return $this->Template(__DIR__ . "/../Templates/AllUsers/UserListElement.php", $user->ToArray());
    }

    /**
     * @return string
     */
    private function UserForm(): string
    {
        return $this->Template(__DIR__ . "/../Templates/Index/form_registration.html");
    }
}
