<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public const COMMENT_1 = 'comment 1';
    public const COMMENT_2 = 'comment 2';

    public function load(ObjectManager $manager)
    {

        $com1 = new Comment();
        $com1->setPseudo('Pseudo 1');
        $com1->setContent('Content 1');
        $manager->persist($com1);

        $com2 = new Comment();
        $com2->setPseudo('Pseudo 2');
        $com2->setContent('Content 2');
        $manager->persist($com2);
        
        $manager->flush();

        $this->addReference(self::COMMENT_1, $com1);
        $this->addReference(self::COMMENT_2, $com2);
    }
}
