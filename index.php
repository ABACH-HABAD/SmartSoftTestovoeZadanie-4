<?php

include_once __DIR__ . '/Controllers/IndexController.php';

use Controllers\IndexController;

(new IndexController())->View();
