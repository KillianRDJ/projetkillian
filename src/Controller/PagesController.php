<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    /**
     * @Route("/", name="pages")
     */
    public function index()
    {
        return $this->render('pages/index.html.twig', [
            
        ]);
    }
}