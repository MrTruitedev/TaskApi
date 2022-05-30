<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('task:readAll')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups('task:readAll')]
    private $name_user;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups('task:readAll')]
    private $first_name_user;

    #[ORM\Column(type: 'string', length: 50)]
    #[Groups('task:readAll')]
    private $login_user;

    #[ORM\Column(type: 'string', length: 100)]
    #[Groups('task:readAll')]
    private $mdp_user;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: Task::class)]
    private $task_id;

    public function __construct()
    {
        $this->task_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameUser(): ?string
    {
        return $this->name_user;
    }

    public function setNameUser(string $name_user): self
    {
        $this->name_user = $name_user;

        return $this;
    }

    public function getFirstNameUser(): ?string
    {
        return $this->first_name_user;
    }

    public function setFirstNameUser(string $first_name_user): self
    {
        $this->first_name_user = $first_name_user;

        return $this;
    }

    public function getLoginUser(): ?string
    {
        return $this->login_user;
    }

    public function setLoginUser(string $login_user): self
    {
        $this->login_user = $login_user;

        return $this;
    }

    public function getMdpUser(): ?string
    {
        return $this->mdp_user;
    }

    public function setMdpUser(string $mdp_user): self
    {
        $this->mdp_user = $mdp_user;

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
            $taskId->setUserId($this);
        }

        return $this;
    }

    public function removeTaskId(Task $taskId): self
    {
        if ($this->task_id->removeElement($taskId)) {
            // set the owning side to null (unless already changed)
            if ($taskId->getUserId() === $this) {
                $taskId->setUserId(null);
            }
        }

        return $this;
    }
}
