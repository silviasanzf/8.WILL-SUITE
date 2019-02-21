<?php

namespace App\Controller;

use App\Entity\Hairiness;
use App\Form\HairinessType;
use App\Repository\HairinessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hairiness")
 */
class HairinessController extends AbstractController
{
    /**
     * @Route("/", name="hairiness_index", methods="GET")
     */
    public function index(HairinessRepository $hairinessRepository): Response
    {
        return $this->render('hairiness/index.html.twig', ['hairinesses' => $hairinessRepository->findAll()]);
    }

    /**
     * @Route("/new", name="hairiness_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $hairiness = new Hairiness();
        $form = $this->createForm(HairinessType::class, $hairiness);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hairiness);
            $em->flush();

            return $this->redirectToRoute('hairiness_index');
        }

        return $this->render('hairiness/new.html.twig', [
            'hairiness' => $hairiness,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hairiness_show", methods="GET")
     */
    public function show(Hairiness $hairiness): Response
    {
        return $this->render('hairiness/show.html.twig', ['hairiness' => $hairiness]);
    }

    /**
     * @Route("/{id}/edit", name="hairiness_edit", methods="GET|POST")
     */
    public function edit(Request $request, Hairiness $hairiness): Response
    {
        $form = $this->createForm(HairinessType::class, $hairiness);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hairiness_index', ['id' => $hairiness->getId()]);
        }

        return $this->render('hairiness/edit.html.twig', [
            'hairiness' => $hairiness,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hairiness_delete", methods="DELETE")
     */
    public function delete(Request $request, Hairiness $hairiness): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hairiness->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hairiness);
            $em->flush();
        }

        return $this->redirectToRoute('hairiness_index');
    }
}
