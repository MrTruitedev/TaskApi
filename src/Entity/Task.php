<?php
    namespace App\Entity;
    use App\Repository\TaskRepository;
    use Doctrine\ORM\Mapping as ORM;
    #[ORM\Entity(repositoryClass: TaskRepository::class)]
    class Task
    {
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column(type: 'integer')]
        #[Groups('task:readAll')]
        private $id;
        #[ORM\Column(type: 'string', length: 255)]
        #[Groups('task:readAll')]
        private $name_task;
        #[ORM\Column(type: 'text')]
        #[Groups('task:readAll')]
        private $content_task;
        #[ORM\Column(type: 'datetime')]
        #[Groups('task:readAll')]
        private $date_task;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameTask(): ?string
    {
        return $this->name_task;
    }

    public function setNameTask(string $name_task): self
    {
        $this->name_task = $name_task;

        return $this;
    }

    public function getContentTask(): ?string
    {
        return $this->content_task;
    }

    public function setContentTask(string $content_task): self
    {
        $this->content_task = $content_task;

        return $this;
    }

    public function getDateTask(): ?\DateTimeInterface
    {
        return $this->date_task;
    }

    public function setDateTask(\DateTimeInterface $date_task): self
    {
        $this->date_task = $date_task;

        return $this;
    }

    public function getCatId(): ?Cat
    {
        return $this->cat_id;
    }

    public function setCatId(?Cat $cat_id): self
    {
        $this->cat_id = $cat_id;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
