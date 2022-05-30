<?php
    namespace App\Controller;
    use App\Entity\Task;
    use App\Repository\CatRepository;
    use App\Repository\TaskRepository;
    use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Serializer\SerializerInterface;
    use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Config\Framework\RequestConfig;

    class TaskController extends AbstractController
    {
        // je rajoute à la route la méthode associée GET
        #[Route('/task', name: 'app_task_index', methods: 'GET')]
        public function index(
            TaskRepository $taskRepository,
        ): Response {
            return $this->json($taskRepository->findAll(),200, [], ['groups' =>
            'task:readAll']);
        }
    

    #[Route('/task', name: 'app_task_index1', methods: 'POST')]
    public function create_task(
        Request $request,
        UserRepository $userRepository,
        CatRepository $catRepository,
        SerializerInterface $serializer,
        EntityManagerInterface $em
    ) : Response{
        $task_recup = $request->getContent();
        //Décodage du json récupéré
        $data = $serializer->decode($task_recup, 'json');
        //Récuperation du user par son id
        $user = $userRepository->find($data['users']['id']);
        //récuperation de la categorie par son id
        $cat = $catRepository->find($data['cats']['id']);
        //création d'une nouvelle tache
        $task = new Task();
        $task->setNameTask($data['name_task']);
        $task->setContentTask($data['content_task']);
        $task->setDateTask(new \DateTimeImmutable);
        $task->setUserId($user);
        $task->setCatId($cat);
        //On fait persister les données
        $em->persist($task);
        //ON envoie en bdd
        $em->flush();
        dd($task);
    }
    }