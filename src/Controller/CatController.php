<?php
namespace App\Controller;

use App\Entity\Cat;
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
            CatRepository $catRepository,
        ): Response {
            return $this->json($catRepository->findAll(),200, [], ['groups' =>
            'task:readAll']);
        }
    
    #[Route('/cat', name: 'app_cat_index1', methods: 'POST')]
    public function create_cat(
        Request $request,
        TaskRepository $taskRepository,
        SerializerInterface $serializer,
        EntityManagerInterface $em
    ) : Response{
        $cat_recup = $request->getContent();
        //Décodage du json récupéré
        $data = $serializer->decode($cat_recup, 'json');
        //Récuperation du task par son id
        $task = $taskRepository->find($data['task']['id']);
        //création d'une nouvelle cat
        $cat = new Cat();
        $cat->setNamecat($data['name_cat']);
        $cat->addTaskId($task);
        //On fait persister les données
        $em->persist($cat);
        //ON envoie en bdd
        $em->flush();
        dd($cat);
    }
}