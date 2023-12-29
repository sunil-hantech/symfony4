<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Todo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TodoFixtures extends TodoBaseFixture
{
    // public function load(ObjectManager $manager): void
    // {
    //     $todo = new Todo();
    //     $todo->setTile('Fixture Title');
    //     $todo->setdescription('this is Fixture Title');
    //     $manager->persist($todo);
    //     $manager->flush();
    // }

    public function loadData(ObjectManager $manager)
    {
        // echo "function called";
        // die();
        $this->createMany(Todo::class,2,function(Todo $todo,$num){

            $todo->setTile("Title from load fixture {$num}");
            $todo->setDescription("Description of load fixture {$num}");
        });
        $manager->flush();
    }
}
