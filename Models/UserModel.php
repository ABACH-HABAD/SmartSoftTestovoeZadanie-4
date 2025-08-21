<?php

namespace Models;

include __DIR__ . '/Model.php';
include __DIR__ . '/../Users/User.php';

use Exception;
use Reviews\Review;
use Users\User;

class UserModel extends Model
{
    /**
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $message
     * @return void
     */
    public function AddUserToDataBase($name, $surname, $email, $message)
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        if (empty($name) || empty($surname) || empty($email) || empty($message)) {
            throw new Exception("Все поля обязательны для заполнения");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Некорректный email");
        }

        if ($this->FindByEmail($email)) {
            throw new Exception("На данную почту аккаунт уже зарегестрирован");
        }

        $query = "INSERT INTO smartsoft.users (name, surname, email, message) VALUES (?, ?, ?, ?);";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssss", $name, $surname, $email, $message);

        if (!$stmt->execute()) {
            throw new Exception("Ошибка при добавлении пользователя: " . $this->connection->error);
        }

        $stmt->close();
    }

    /**
     * @param int $id
     * @return void
     */
    public function DeleteUserInDataBase($id)
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        $reviewCheckQuery = "SELECT id FROM smartsoft.reviews WHERE user = ?;";
        $stmt = $this->connection->prepare($reviewCheckQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $deleteReviewsQuery = "DELETE FROM smartsoft.reviews WHERE id = ?;";
            $stmt2 = $this->connection->prepare($deleteReviewsQuery);
            $stmt2->bind_param("i", $result->fetch_assoc()['id']);
            $stmt2->execute();
            $stmt2->close();
        }

        $stmt->close();

        $deleteUserQuery = "DELETE FROM smartsoft.users WHERE id = ?;";
        $stmt3 = $this->connection->prepare($deleteUserQuery);
        $stmt3->bind_param("i", $id);

        if (!$stmt3->execute()) {
            throw new Exception("Ошибка при удалении пользователя: " . $this->connection->error);
        }

        $stmt3->close();
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $message
     * @return void
     */
    public function EditUserInDataBase($id, $name, $surname, $email, $message)
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        $query = "UPDATE smartsoft.users SET name = ?, surname = ?, email = ?, message=? WHERE id = ?;";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ssssi", $name, $surname, $email, $message, $id);

        if (!$stmt->execute()) {
            throw new Exception("Ошибка при изменении данных пользователя: " . $this->connection->error);
        }

        $stmt->close();
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function FindByEmail($email)
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        if (empty($email)) {
            throw new Exception("Укажите электронную почту");
        }

        $query = "SELECT * FROM smartsoft.users WHERE email = ?;";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        if ($result = $stmt->get_result()) {
            foreach ($result as $row) {
                $user =  new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["message"]);
                return $user;
            }
        } else {
            throw new Exception("Ошибка при поиске пользователя: " . $this->connection->error);;
        }

        $stmt->close();
    }

    /**
     * @param int $userID
     * @return User|null
     */
    public function FindByID($userID)
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        $query = "SELECT * FROM smartsoft.users WHERE id = ?;";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();

        if ($result = $stmt->get_result()) {
            foreach ($result as $row) {
                $user =  new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["message"]);
                return $user;
            }
        } else {
            throw new Exception("Ошибка при поиске пользователя: " . $this->connection->error);;
        }

        $stmt->close();
    }

    /**
     * @return array|null|void
     */
    public function GetAllUsers()
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        $query = "SELECT * FROM smartsoft.users;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        if ($result = $stmt->get_result()) {
            $array = array();
            foreach ($result as $row) {
                $array[] = new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["message"]);
            }
            return $array;
        } else {
            throw new Exception("Ошибка при получении списка пользователей " . $this->connection->error);;
        }

        $stmt->close();
    }
}
