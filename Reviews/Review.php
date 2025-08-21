<?php

namespace Reviews;

use Exception;

class Review
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;
    private $comment;

    /**
     * @param string $name
     * @param string $comment
     * @param int $id
     * @return void
     */
    function __construct($name, $comment, $id = 0)
    {
        if (empty($name) || empty($comment)) {
            throw new Exception("Имя и комментарий не могут быть пустыми");
        }
        $this->name = $name;
        $this->comment = $comment;
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function ToArray(): array
    {
        return array("name" => $this->name, "comment" => $this->comment, "id" => ($this->id != null) ? $this->id = $this->id : 0);
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
    public function getComment(): string
    {
        return $this->comment;
    }
}
