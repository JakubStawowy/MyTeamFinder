<?php


class Feedback
{
    private $addedById;
    private $comment;
    private $userImage;
    private $createdAt;
    private $addedByNameSurname;

    public function __construct(int $addedById, string $comment, string $userImage, string $createdAt, string $addedByNameSurname)
    {
        $this->addedById = $addedById;
        $this->comment = $comment;
        $this->userImage = $userImage;
        $this->createdAt = $createdAt;
        $this->addedByNameSurname = $addedByNameSurname;
    }

    public function getAddedById(): int
    {
        return $this->addedById;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getUserImage(): string
    {
        return $this->userImage;
    }

    public function getCreatedAt(): string
    {

        return substr($this->createdAt, 0, 10);
    }

    public function getAddedByNameSurname(): string
    {
        return $this->addedByNameSurname;
    }
}