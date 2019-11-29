<?php

namespace App\Controller;

use App\Entity\Definition;
use App\Form\DefinitionType;
use App\Repository\DefinitionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/definition")
 */
class DefinitionController extends AbstractController
{
    /**
     * @Route("/", name="definition_index", methods={"GET"})
     */
    public function index(DefinitionRepository $definitionRepository): Response
    {
        return $this->render('definition/index.html.twig', [
            'definitions' => $definitionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="definition_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $definition = new Definition();
        $form = $this->createForm(DefinitionType::class, $definition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($definition);
            $entityManager->flush();

            return $this->redirectToRoute('definition_index');
        }

        return $this->render('definition/new.html.twig', [
            'definition' => $definition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="definition_show", methods={"GET"})
     */
    public function show(Definition $definition): Response
    {
        return $this->render('definition/show.html.twig', [
            'definition' => $definition,
        ]);
    }

    /**
     * @route("/{id}/edit", name="definition_edit", methods={"GET", "POST"})
     * @IsGranted("ARTICLE_EDIT", subject="definition")
     */
    public function edit(Request $request, Definition $definition)
    {
        $form =$this->createForm(DefinitionType::class, $definition
        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->persistDefinition($definition, 'La balise a bien été modifiée');
        }
        return $this->render('definition/update.html.twig', [

            'form' => $form->createView(),
            'definition' => $definition,

        ]);
    }

    /**
     * @Route("/{id}", name="definition_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Definition $definition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$definition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($definition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('definition_index');
    }

    private function persistDefinition(Definition $definition, string $string)
    {
        $em =$this->getDoctrine()->getManager();
        $em->persist($definition);
        $em->flush();
//        $this->addFlash('success', $message);

        return $this->redirectToRoute('definition_show', [
            'id' => $definition->getId(),
        ]);
    }
}
