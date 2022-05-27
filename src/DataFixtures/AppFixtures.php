<?php
    namespace App\DataFixtures;
    use Faker\Factory;
    use App\Entity\User;
    use App\Entity\Cat;
    use App\Entity\Task;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Persistence\ObjectManager;
    use Faker;
    class AppFixtures extends Fixture
    {
        public function load(ObjectManager $manager): void
        {
            //création d'une variable qui va contenir
            $faker = Faker\Factory::create('fr-FR');
            //Tableau vide qui va stocker les utilisateurs que l’on génère
            $users = [];
            //Boucle qui va itérer 20 utilisateurs factices
            for($i=0; $i<100; $i++){
                $user = new User();
                //génération d'un utilisateur factice
                $user->setNameUser($faker->lastName());
                $user->setFirstNameUser($faker->firstname());
                $user->setLoginUser($faker->email());
                $user->setMdpUser($faker->password());
                //stockage dans le manager
                $manager->persist($user);
                $users[] = $user;
            }
            $cats = [];
            //Boucle qui va itérer 10 categories factices
            for($i=0; $i<50; $i++){
                $cat = new Cat();
                //génération d'un utilisateur factice
                $cat->setNameCat($faker->lastName());
                //stockage dans le manager
                $manager->persist($cat);
                $cats[] = $cat;
            }
            $articles = [];
            //Boucle qui va itérer 100 articles factices
            for($i=0; $i<400; $i++){
                $art = new Task();
                //génération d'un utilisateur factice
                $art->setNameTask($faker->lastName());
                $art->setContentTask($faker->text(200));
                $art->setDateTask(new \DateTimeImmutable());
                //stockage dans le manager
                $manager->persist($art);
                $articles[] = $art;
            }
            $manager->flush();
        }
    }
