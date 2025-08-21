<?php

namespace Users;

use Exception;

class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;
    private $surname;
    private $email;
    private $message;

    /**
     * @param int $id
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string|null $message
     * @return void
     */
    function __construct($id, $name, $surname, $email, $message)
    {
        if (empty($name) || empty($surname) || empty($email)) {
            throw new Exception("Имя, фамилия и электронная почта не могут быть пустыми. Полученный ответ: id: " . $id . " name: " . $name . " surname: " . $surname . " email: " . $email . " name: " . $message);
        }
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function ToArray(): array
    {
        return array("id" => $this->id, "name" => $this->name, "surname" => $this->surname, "email" => $this->email,  "message" => $this->message);
    }

    /**
     * @return int
     */
    public function getID(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }
}
