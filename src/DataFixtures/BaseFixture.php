<?php
namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

abstract class BaseFixture extends Fixture
{
    /** @var ObjectManager */
    private $manager;

     /** @var Generator */
    protected $faker;

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->faker = Factory::create();

        $this->loadData($manager);
//         $article = new Article();
//         $article->setAuthor('John')
//             ->setImageFilename('asteroid.jpeg')
//             ->setHeartCount(rand(5, 100))
//             ->setTitle('Why Asteroids Taste Like Bacon')
//             ->setSlug('why-asteroids-taste-like-bacon-' . rand(100, 999))
//             ->setContent(
//                 <<<EOF
// Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
// lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
// labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
// **turkey** shank eu pork belly meatball non cupim.
// Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
// laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
// capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
// picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
// occaecat lorem meatball prosciutto quis strip steak.
// Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
// mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
// strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
// cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
// fugiat.
// EOF
//             );
//         if (rand(1, 10) > 2) {
//             $article->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))));
//         }
       
//         $manager->persist($article);
//         $manager->flush();
    }

    abstract protected function loadData(ObjectManager $manager);


    protected function createMany(string $className, int $count, callable $factory)
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = new $className();
            $factory($entity, $i);
            $this->manager->persist($entity);
            // store for usage later as App\Entity\ClassName_#COUNT#
            $this->addReference($className . '_' . $i, $entity);
        }
    }
}