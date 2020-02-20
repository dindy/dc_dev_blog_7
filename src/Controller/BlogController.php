<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    public function home()
    {
        $doctrine = $this->getDoctrine();
        $postsRepository = $doctrine->getRepository(Post::class);
        $posts = $postsRepository->findAll();
        
        $categoriesRepository = $doctrine->getRepository(Category::class);
        $categories = $categoriesRepository->findAll();
        
        return $this->render('home.html.twig', [
            'posts' => $posts,
            'categories' => $categories
            ]);
        }
        
        public function post($id) 
        {
            $doctrine = $this->getDoctrine();
            $postsRepository = $doctrine->getRepository(Post::class);
            $post = $postsRepository->find($id);
            
            if (!$post) {
                throw $this->createNotFoundException('Pas d\'article trouvé pour l\'id '.$id);            
            }
            
            $categoriesRepository = $doctrine->getRepository(Category::class);
            $categories = $categoriesRepository->findAll();
            
            return $this->render('post.html.twig', [
                'post' => $post,
                'categories' => $categories
            ]);
    }     
}