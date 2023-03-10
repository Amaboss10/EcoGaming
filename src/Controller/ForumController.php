<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\CommentType;
use App\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


class ForumController extends AbstractController
{
    #[Route('/forum/{id}', name: 'app_forumpost')]
	 public function index(EntityManagerInterface $entityManager, int $id): Response
    {
        $post = $entityManager->getRepository(Posts::class)->findBy(['id' => $id], []);
     
	 //On met le $post[0] à null, comme ça le twig peut handle l'erreur
        if(!$post[0]) {
            $post = [null];
        }
		
        $commentForm = $this->createForm(CommentType::class);
		
        return $this->render('forum/index.html.twig', [
            'post' => $post[0],
            'user' => $this->getUser(),
            'commentForm' => $commentForm->createView()
        ]);
    }
	
    #[Route("/forum/{id}/comment/add", name: "add_comment")]
    public function addComment(Request $request, EntityManagerInterface $entityManager, Posts $post): Response
    {
        $comment = new Comments();
        $comment->setUser($this->getUser());
        $comment->setPost($post);

        $commentForm = $this->createForm(CommentType::class, $comment);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post', [
            'id' => $post->getId()
        ]);
    }
	
	#[Route('/forum', name: 'app_forum')]
    public function indexArticle(EntityManagerInterface $entityManager): Response
    {
        $posts = $entityManager->getRepository(Posts::class)->findAll();

        return $this->render('forum/forum.html.twig', [
            'posts' => $posts,
            'user' => $this->getUser()
        ]);
    }
}