<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

class BlogController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->postsRepo = $entityManager->getRepository(Post::class);
        $this->categoriesRepo = $entityManager->getRepository(Category::class);
        $this->categories = $this->categoriesRepo->findAll();
    } 

    public function home()
    {
        $posts = $this->postsRepo->findAll();
        
        return $this->render('home.html.twig', [
            'posts' => $posts,
            'categories' => $this->categories
        ]);
    }
        
    public function post($id) 
    {
        $post = $this->postsRepo->find($id);
        
        if (!$post)  
            throw $this->createNotFoundException('Pas d\'article trouvé pour l\'id '.$id);            
        
        return $this->render('post.html.twig', [
            'post' => $post,
            'categories' => $this->categories
        ]);
    }     

    public function category($id) 
    {
        $category = $this->categoriesRepo->find($id);
        
        if (!$category)  
            throw $this->createNotFoundException('Pas de catégorie trouvée pour l\'id '.$id);            
        
        return $this->render('category.html.twig', [
            'category' => $category,
            'categories' => $this->categories
        ]);        
    }
}