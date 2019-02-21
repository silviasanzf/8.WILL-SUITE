<?php

namespace App\Controller;

use App\Entity\Transformation;
use App\Form\TransformationType;
use App\Repository\TransformationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/transformation")
 */
class TransformationController extends AbstractController
{
    /**
     * @Route("/", name="transformation_index", methods="GET")
     */
    public function index(TransformationRepository $transformationRepository): Response
    {
        return $this->render(
            'transformation/index.html.twig',
            ['transformations' => $transformationRepository->findAll()]
        );
    }

    /**
     * @Route("/new", name="transformation_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $transformation = new Transformation();
        $form = $this->createForm(TransformationType::class, $transformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($transformation);
            $em->flush();

            return $this->redirectToRoute('transformation_index');
        }

        return $this->render('transformation/new.html.twig', [
            'transformation' => $transformation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transformation_show", methods="GET")
     */
    public function show(Transformation $transformation): Response
    {
        return $this->render('transformation/show.html.twig', ['transformation' => $transformation]);
    }

    /**
     * @Route("/{id}/edit", name="transformation_edit", methods="GET|POST")
     */
    public function edit(Request $request, Transformation $transformation): Response
    {
        $form = $this->createForm(TransformationType::class, $transformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transformation_index', ['id' => $transformation->getId()]);
        }

        return $this->render('transformation/edit.html.twig', [
            'transformation' => $transformation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transformation_delete", methods="DELETE")
     */
    public function delete(Request $request, Transformation $transformation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transformation->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($transformation);
            $em->flush();
        }

        return $this->redirectToRoute('transformation_index');
    }
}
