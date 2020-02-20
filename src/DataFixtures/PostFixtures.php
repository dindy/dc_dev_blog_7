<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Définition d'un nouveau post
        $post = new Post();
        $post->setTitle('Title 1');
        $post->setContent('Content 1');
        $post->setCreated(new \DateTime('2011-01-01T15:03:01'));
        $manager->persist($post);
        
        // Définition d'un nouveau post
        $post = new Post();
        $post->setTitle('Title 2');
        $post->setContent('Content 2');
        $post->setCreated(new \DateTime('2011-01-01T15:03:01'));        
        $manager->persist($post);
        
        // Définition d'un nouveau post
        $post = new Post();
        $post->setTitle('Title 3');
        $post->setContent('Content 3');
        $post->setCreated(new \DateTime('2011-01-01T15:03:01'));
        $manager->persist($post);

        // Enregistrement en bdd
        $manager->flush();
    }
}
