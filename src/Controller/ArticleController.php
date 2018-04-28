<?php

namespace App\Controller;
use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ArticleController extends Controller
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
               
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

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


        // or render a template
        // in the template, print things with {{ product.name }}
        return $this->render('article/index.html.twig', ['article' => $article]);
    }
  

}