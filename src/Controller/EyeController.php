<?php

namespace App\Controller;

use App\Entity\Eye;
use App\Form\EyeType;
use App\Repository\EyeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/eye")
 */
class EyeController extends AbstractController
{
    /**
     * @Route("/", name="eye_index", methods="GET")
     */
    public function index(EyeRepository $eyeRepository): Response
    {
        return $this->render('eye/index.html.twig', ['eyes' => $eyeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="eye_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $eye = new Eye();
        $form = $this->createForm(EyeType::class, $eye);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($eye);
            $em->flush();

            return $this->redirectToRoute('eye_index');
        }

        return $this->render('eye/new.html.twig', [
            'eye' => $eye,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="eye_show", methods="GET")
     */
    public function show(Eye $eye): Response
    {
        return $this->render('eye/show.html.twig', ['eye' => $eye]);
    }

    /**
     * @Route("/{id}/edit", name="eye_edit", methods="GET|POST")
     */
    public function edit(Request $request, Eye $eye): Response
    {
        $form = $this->createForm(EyeType::class, $eye);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('eye_index', ['id' => $eye->getId()]);
        }

        return $this->render('eye/edit.html.twig', [
            'eye' => $eye,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="eye_delete", methods="DELETE")
     */
    public function delete(Request $request, Eye $eye): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eye->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($eye);
            $em->flush();
        }

        return $this->redirectToRoute('eye_index');
    }
}
