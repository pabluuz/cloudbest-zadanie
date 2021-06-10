<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class AbstractFixture extends Fixture
{
    abstract protected function loadData();

    /** @var ObjectManager */
    protected $objectManager;
    /** @var Generator */
    protected $generator;

    /**
     * @param ObjectManager $objectManager
     */
    public function load(ObjectManager $objectManager) : void
    {
        $this->objectManager = $objectManager;
        $this->generator = Factory::create();
        $this->loadData();
    }
}
