<?php
namespace App\Controller;
use App\Entity\Task;
use App\Repository\CatRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class CatController extends AbstractController
{
        // je rajoute à la route la méthode associée GET
        #[Route('/cat', name: 'app_cat_index', methods: 'GET')]
        public function index(
            TaskRepository $taskRepository,
        ): Response {
            return $this->json($taskRepository->findAll(),200, [], ['groups' =>
            'user:readAll']);
        }
    }