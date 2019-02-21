<?php

namespace App\Controller;

use App\Entity\Hair;
use App\Form\HairType;
use App\Repository\HairRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hair")
 */
class HairController extends AbstractController
{
    /**
     * @Route("/", name="hair_index", methods="GET")
     */
    public function index(HairRepository $hairRepository): Response
    {
        return $this->render('hair/index.html.twig', ['hairs' => $hairRepository->findAll()]);
    }

    /**
     * @Route("/new", name="hair_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $hair = new Hair();
        $form = $this->createForm(HairType::class, $hair);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hair);
            $em->flush();

            return $this->redirectToRoute('hair_index');
        }

        return $this->render('hair/new.html.twig', [
            'hair' => $hair,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hair_show", methods="GET")
     */
    public function show(Hair $hair): Response
    {
        return $this->render('hair/show.html.twig', ['hair' => $hair]);
    }

    /**
     * @Route("/{id}/edit", name="hair_edit", methods="GET|POST")
     */
    public function edit(Request $request, Hair $hair): Response
    {
        $form = $this->createForm(HairType::class, $hair);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hair_index', ['id' => $hair->getId()]);
        }

        return $this->render('hair/edit.html.twig', [
            'hair' => $hair,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hair_delete", methods="DELETE")
     */
    public function delete(Request $request, Hair $hair): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hair->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hair);
            $em->flush();
        }

        return $this->redirectToRoute('hair_index');
    }
}
