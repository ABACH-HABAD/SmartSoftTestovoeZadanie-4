<?php

namespace Core;

abstract class Config
{
    /**
     * @var string
     */
    protected $server = "localhost";
    protected $user = "root";
    protected $password = "123456789";
    protected $db_name = "smartsoft";

    /**
     * @var int
     */
    protected $port = 3307; //3306
}
