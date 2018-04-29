<?php

namespace App\Controller;
use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    /**
     * @Route("/", name="Home")
     */
    public function index()
    {
        // get article
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        
        return $this->render('pages/index.html.twig', [
            'article' => $article,
        ]);
    }
}
