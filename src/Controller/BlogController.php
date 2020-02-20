<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    public function list()
    {
        $doctrine = $this->getDoctrine();
        $postsRepository = $doctrine->getRepository(Post::class);
        $posts = $postsRepository->findAll();

        return $this->render('home.html.twig', ['posts' => $posts]);
    }
} 