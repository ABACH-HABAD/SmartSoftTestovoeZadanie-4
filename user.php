<?php

include_once __DIR__ . '/Controllers/UserController.php';

use Controllers\UserController;

(new UserController())->View();
