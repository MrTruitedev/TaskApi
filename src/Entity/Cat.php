<?php

namespace App\Entity;

use App\Repository\CatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CatRepository::class)]
class Cat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('task:readAll')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups('task:readAll')]
    private $name_cat;

    #[ORM\OneToMany(mappedBy: 'cat_id', targetEntity: Task::class)]
    private $task_id;

    public function __construct()
    {
        $this->task_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCat(): ?string
    {
        return $this->name_cat;
    }

    public function setNameCat(string $name_cat): self
    {
        $this->name_cat = $name_cat;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTaskId(): Collection
    {
        return $this->task_id;
    }

    public function addTaskId(Task $taskId): self
    {
        if (!$this->task_id->contains($taskId)) {
            $this->task_id[] = $taskId;
            $taskId->setCatId($this);
        }

        return $this;
    }

    public function removeTaskId(Task $taskId): self
    {
        if ($this->task_id->removeElement($taskId)) {
            // set the owning side to null (unless already changed)
            if ($taskId->getCatId() === $this) {
                $taskId->setCatId(null);
            }
        }

        return $this;
    }
}
