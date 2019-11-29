<?php

namespace App\Controller;

use App\Repository\DefinitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class AboutController extends AbstractController
{
    /**
     * @Route("/page3", methods="GET", name="page3")
     */
    public function index1(DefinitionRepository $repository)

    {
        $definition = $repository->findLatestPublished();

        return $this->render('about/page3.html.twig', [
            'definition' => $definition,
        ]);
    }


    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('about/index.html.twig');
    }

    /**
     * @Route("/page1/", name="page1")
     */
    public function page1()
    {
        return $this->render('about/page1.html.twig');
    }

    /**
     * @Route("/page2/", name="page2")
     */
    public function page2()
    {
        return $this->render('about/page2.html.twig');
    }

    /**
     * @Route("/formulaire/", name="form_contact")
     */
    public function formulaire()
    {
        return $this->render('about/formulaire.html.twig');
    }
}
