<?php

namespace App\Controller;

use App\Entity\Corpulence;
use App\Form\CorpulenceType;
use App\Repository\CorpulenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/corpulence")
 */
class CorpulenceController extends AbstractController
{
    /**
     * @Route("/", name="corpulence_index", methods="GET")
     */
    public function index(CorpulenceRepository $corpulenceRepository): Response
    {
        return $this->render('corpulence/index.html.twig', ['corpulences' => $corpulenceRepository->findAll()]);
    }

    /**
     * @Route("/new", name="corpulence_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $corpulence = new Corpulence();
        $form = $this->createForm(CorpulenceType::class, $corpulence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($corpulence);
            $em->flush();

            return $this->redirectToRoute('corpulence_index');
        }

        return $this->render('corpulence/new.html.twig', [
            'corpulence' => $corpulence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="corpulence_show", methods="GET")
     */
    public function show(Corpulence $corpulence): Response
    {
        return $this->render('corpulence/show.html.twig', ['corpulence' => $corpulence]);
    }

    /**
     * @Route("/{id}/edit", name="corpulence_edit", methods="GET|POST")
     */
    public function edit(Request $request, Corpulence $corpulence): Response
    {
        $form = $this->createForm(CorpulenceType::class, $corpulence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('corpulence_index', ['id' => $corpulence->getId()]);
        }

        return $this->render('corpulence/edit.html.twig', [
            'corpulence' => $corpulence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="corpulence_delete", methods="DELETE")
     */
    public function delete(Request $request, Corpulence $corpulence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$corpulence->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($corpulence);
            $em->flush();
        }

        return $this->redirectToRoute('corpulence_index');
    }
}
