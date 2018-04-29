<?php

namespace App\Controller;
use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
     * @Route("/article/add", name="article_add")
     */
    public function addArticle(){
        
    }

    /**
     * @Route("/article/edit/{id}", name="article_edit")
     */
    public function editArticle($id){
        
    }
  

}