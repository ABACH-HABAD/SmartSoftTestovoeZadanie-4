<?php

namespace Models;

include __DIR__ . '/Model.php';
include __DIR__ . '/../Reviews/Review.php';

use Exception;
use Models\Model;
use Reviews\Review;

class ReviewModel extends Model
{
    /**
     * @return array|null|void
     */
    public function GetReviews()
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        $query = "SELECT name, comment FROM smartsoft.reviews JOIN smartsoft.users ON users.id = reviews.user ORDER BY RAND() LIMIT 6;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        if ($result = $stmt->get_result()) {
            $array = array();
            foreach ($result as $row) {
                $array[] = new Review($row["name"], $row["comment"]);
            }
            return $array;
        } else {
            throw new Exception("Ошибка при получении отзывов: " . $this->connection->error);
        }

        $stmt->close();
    }

    /**
     * @param int $userID
     * @return Review|null|void
     */
    public function FindReviewByUserID($userID)
    {
        if ($this->connection == null) return;

        if (empty($userID)) {
            throw new Exception("Нужно указать ID");
        }

        $query = "SELECT name, comment FROM smartsoft.reviews JOIN smartsoft.users ON users.id = reviews.user WHERE  users.id = ?;";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();

        if ($result = $stmt->get_result()) {
            foreach ($result as $row) {
                $foundReview = new Review($row["name"], $row["comment"]);
                return $foundReview;
            }
        } else {
            throw new Exception("Ошибка при поиске отзыва: " . $this->connection->error);
        }

        $stmt->close();
    }

    /**
     * @param int $userID
     * @param string $comment
     * @return void
     */
    public function AddReviewToDataBase($userID, $comment)
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        if (empty($userID)) {
            throw new Exception("Нужно указать ID");
        }

        if ($this->FindReviewByUserID($userID)) {
            $this->ChangeReviewInDataBase($userID, $comment);
            return;
        }

        if (empty($comment)) {
            throw new Exception("Все поля обязательны для заполнения");
        }

        $query = "INSERT INTO smartsoft.reviews (user, comment) VALUES (?, ?);";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("is", $userID, $comment);

        if (!$stmt->execute()) {
            throw new Exception("Ошибка при добавлении отзыва в базу данных: " . $this->connection->error);
        }

        $stmt->close();
    }

    public function DeleteReviewInDataBase($id)
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        $query = "DELETE FROM smartsoft.reviews WHERE id = ?;";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception("Ошибка при удалении отзыва: " . $this->connection->error);
        }

        $stmt->close();
    }

    /**
     * @param int|string $userID_or_Name
     * @param string $comment
     * @return void
     */
    public function ChangeReviewInDataBase($userID_or_Name, $comment)
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        if (empty($userID_or_Name)) {
            throw new Exception("Нужно указать ID или имя пользователя");
        }

        if (empty($comment)) {
            throw new Exception("Все поля обязательны для заполнения");
        }


        if (is_numeric($userID_or_Name)) {
            $query = "UPDATE smartsoft.reviews SET comment=? WHERE user=?;";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("si", $comment, $userID_or_Name);
        } else {
            $query = "UPDATE smartsoft.reviews SET comment=? WHERE user=(SELECT id FROM smartsoft.users WHERE name=?);";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ss", $comment, $userID_or_Name);
        }

        if (!$stmt->execute()) {
            throw new Exception("Ошибка при изменении отзыва: " . $this->connection->error);
        }

        $stmt->close();
    }

    /**
     * @return array|null|void
     */
    public function GetAllReviews()
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");


        $query = "SELECT reviews.id AS id, name, comment FROM smartsoft.reviews JOIN smartsoft.users ON users.id = reviews.user;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        if ($result = $stmt->get_result()) {
            $array = array();
            foreach ($result as $row) {
                $array[] = new Review($row["name"], $row["comment"], $row["id"]);
            }
            return $array;
        } else {
            throw new Exception("Ошибка при получении отзывов: " . $this->connection->error);
        }

        $stmt->close();
    }
}
