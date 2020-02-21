<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Category;
use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CommentType;

class BlogController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager) 
    {
        $this->postsRepo = $entityManager->getRepository(Post::class);
        $this->categoriesRepo = $entityManager->getRepository(Category::class);
        $this->categories = $this->categoriesRepo->findAll();
        $this->entityManager = $entityManager;
    } 

    public function home()
    {
        $posts = $this->postsRepo->findAll();
        
        return $this->render('home.html.twig', [
            'posts' => $posts,
            'categories' => $this->categories
        ]);
    }
        
    public function post($id, Request $request) 
    {
        $post = $this->postsRepo->find($id);
        
        if (!$post)  
            throw $this->createNotFoundException('Pas d\'article trouvé pour l\'id '.$id);            

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setPost($post);
            $this->entityManager->persist($comment);
            $this->entityManager->flush();
            return $this->redirectToRoute('post', ['id' => $post->getId()]);
        }

        return $this->render('post.html.twig', [
            'post' => $post,
            'categories' => $this->categories,
            'form' => $form->createView() 
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