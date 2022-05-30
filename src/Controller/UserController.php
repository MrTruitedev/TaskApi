<?php
namespace App\Controller;
use App\Entity\Task;
use App\Entity\User;
use App\Repository\CatRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class UserController extends AbstractController
{
        // je rajoute à la route la méthode associée GET
        #[Route('/user', name: 'app_user_index', methods: 'GET')]
        public function index(
            UserRepository $userRepository,
        ): Response {
            return $this->json($userRepository->findAll(),200, [], ['groups' =>
            'task:readAll']);
        }
    

    #[Route('/user', name: 'app_user_index1', methods: 'POST')]
    public function create_user(
        Request $request,
        TaskRepository $taskRepository,
        SerializerInterface $serializer,
        EntityManagerInterface $em
    ) : Response{
        $user_recup = $request->getContent();
        //Décodage du json récupéré
        $data = $serializer->decode($user_recup, 'json');
        //Récuperation du task par son id
        $task = $taskRepository->find($data['task']['id']);
        //création d'un nouvel user
        $user = new User();
        $user->setNameUser($data['name_user']);
        $user->setFirstNameUser($data['first_name_user']);
        $user->setLoginUser($data['login_user']);
        $user->setMdpUser($data['mdp_user']);
        $user->addTaskId($task);
        //On fait persister les données
        $em->persist($user);
        //ON envoie en bdd
        $em->flush();
        dd($user);
    }
}