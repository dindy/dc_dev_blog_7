<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    public function home()
    {
        $doctrine = $this->getDoctrine();
        $postsRepository = $doctrine->getRepository(Post::class);
        $posts = $postsRepository->findAll();
        
        return $this->render('home.html.twig', ['posts' => $posts]);
    }
    
    public function post($id) {
        $doctrine = $this->getDoctrine();
        $postsRepository = $doctrine->getRepository(Post::class);
        $post = $postsRepository->find($id);

        return $this->render('post.html.twig', ['post' => $post]);
    }     
}