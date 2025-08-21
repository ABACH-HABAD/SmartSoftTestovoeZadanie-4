<?php

namespace Models;

include __DIR__ . '/../Core/Config.php';

use Exception;
use mysqli;
use Core\Config;

class Model extends Config
{
    /**
     * @var string
     */
    const ERROR = "Произошла ошибка при подключении к базе данных: ошибка выполнения запроса к базе данных";

    /**
     * @var mysqli|null
     */
    protected $connection = null;

    /**
     * @return void
     */
    public function __construct()
    {
        if ($this->connection != null) return;
        $this->connection = self::connectToDataBase($this->server, $this->user, $this->password, $this->db_name, $this->port); // "localhost", "root", "123456789"

        if ($this->connection === null) {
            throw new Exception("Не удалось установить соединение с базой данных.");
        }
    }

    /**
     * @param string $address
     * @param string $user
     * @param string $password
     * @param string $database
     * @param int $port
     * @return mysqli|null
     */
    private static function connectToDataBase($address, $user, $password, $database, $port)
    {
        try {
            $connection = mysqli_init();

            $connection->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, true);
            $connection->options(MYSQLI_INIT_COMMAND, "SET NAMES 'utf8'");

            if (!$connection->real_connect($address, $user, $password, $database, $port)) {
                throw new Exception("Ошибка подключения: " . $connection->connect_error);
            }

            $connection->set_charset("utf8mb4");

            return $connection;
        } catch (Exception $e) {
            return null;
        }
    }
}
