<?php

namespace App\Controller;
use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ArticleController extends Controller
{
    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function showArticle($id)
    {
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id '.$id
            );
        }
        // return article render
        return $this->render('article/index.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/article/add/", name="article_add")
     */
    public function addArticle(Request $request)
    {   
        $newArticle = new Article();
            $form = $this->createForm(ArticleType::class, $newArticle);


            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($newArticle);
                $entityManager->flush();
        
                $this->addFlash(
                    'notice',
                    'Article ajouté'
                );
        
                return $this->redirectToRoute('index');
                
            }
            return $this->render('article/add.html.twig', [
                'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/article/edit/{id}", name="article_edit")
     */
    public function editArticle($id, Request $request){
        $article = $this->getDoctrine()
        ->getRepository(Article::class)
        ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id '.$id
            );
        }

        $form = $this->createFormBuilder($article)
        ->add('id', IntegerType::class)
        ->add('title', TextType::class)
        ->add('content', TextareaType::class)
        ->add('Modifier article', SubmitType::class)
        ->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
        }
        return $this->render('article/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/delete/{id}", name="article_delete")
     */
    public function deleteArticle($id){

        $em = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()
        ->getRepository(Article::class)
        ->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id '.$id
            );
        }
        $em->remove($article);
        $em->flush();

        $this->addFlash(
            'notice',
            'Element supprimée'
        );

        return $this->redirectToRoute('index');

    }
  

}