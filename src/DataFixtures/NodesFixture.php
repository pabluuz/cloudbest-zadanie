<?php

namespace App\DataFixtures;

use App\Entity\Node;

class NodesFixture extends AbstractFixture
{
    /**
     * Chances for left and right child
     */
    private const LEFT_CHANCE = 97;
    private const RIGHT_CHANCE = 99;

    /**
     * Safe switch to prevent using a lot of memory
     */
    private const MEMORY_LIMIT = 1000;

    /**
     * @var string[]
     */
    private const NAMES = [
        'Christopher',
        'Ryan',
        'Ethan',
        'John',
        'Zoey',
        'Sarah',
        'Michelle',
        'Samantha',
        'Anabelle',
        'Stephanie'
    ];

    /**
     * @var string[]
     */
    private const SURNAMES = [
        'Walker',
        'Thompson',
        'Anderson',
        'Johnson',
        'Tremblay',
        'Peter',
        'Cunningham',
        'Simpson',
        'Mercado',
        'Sellers'
    ];

    /**
     * @var int
     * Initiated from -1 since it needs to increment in top of recursion
     */
    private $currentMemoryLeftIndex = -1;
    private $currentMemoryRightIndex = 0;

    /**
     * @return string
     * @throws \Exception
     *
     * RandomUsername is in format NameSurname (no space)
     */
    private function generateRandomUsername(): string
    {
        $randomName = self::NAMES[random_int(0, sizeof(self::NAMES) - 1)];
        $randomSurname = self::SURNAMES[random_int(0, sizeof(self::SURNAMES) - 1)];
        return $randomName . $randomSurname;
    }

    /**
     * @param bool $isLeft if it's left child node (or first node)
     * @param Node|null $parent
     * @return Node
     * @throws \Exception
     */
    private function createOne(bool $isLeft, ?Node $parent): Node
    {
        ($isLeft) ? $this->currentMemoryLeftIndex++ : $this->currentMemoryRightIndex++;
        $entity = new Node;
        if ($parent !== null) {
            $entity->setParent($parent);
        }
        if ($this->generator->boolean(
                self::LEFT_CHANCE - self::LEFT_CHANCE * ($this->currentMemoryLeftIndex / self::MEMORY_LIMIT)) &&
            $this->currentMemoryLeftIndex <= self::MEMORY_LIMIT) {
            $entity->setChildLeft($this->createOne(true, $entity));
        }
        if ($this->generator->boolean(
                self::RIGHT_CHANCE - self::RIGHT_CHANCE * ($this->currentMemoryRightIndex / self::MEMORY_LIMIT)) &&
            $this->currentMemoryRightIndex <= self::MEMORY_LIMIT) {
            $entity->setChildRight($this->createOne(false, $entity));
        }


        $entity->setCreditsLeft($this->generator->randomFloat(2, 0, 500));
        $entity->setCreditsRight($this->generator->randomFloat(2, 0, 500));

        $entity->setUserName($this->generateRandomUsername());

        $this->objectManager->persist($entity);

        return $entity;
    }

    /**
     * @throws \Exception
     */
    protected function loadData()
    {
        $this->createOne(true, null);
        $this->objectManager->flush();
    }
}
