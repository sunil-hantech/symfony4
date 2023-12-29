<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

abstract class TodoBaseFixture extends Fixture
{   
    /** @var ObjectManager */
    private $manager;
    public function load(ObjectManager $manager): void
    {
        $this->manager=$manager;
        $this->loadData($manager);
    }   

    abstract protected function loadData(ObjectManager $manager);

    protected function createMany(string $className,int $count,callable $callbackfunc)
    {
        for($i=0;$i<=$count;$i++)
        {
            $entity=new $className();
            $callbackfunc($entity,$i+1);
            $this->manager->persist($entity);
            // $this->addReference($className . '_' . $i, $entity);
        }

    }
}