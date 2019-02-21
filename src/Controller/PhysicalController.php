<?php

namespace App\Controller;

use App\Entity\Physical;
use App\Form\PhysicalType;
use App\Repository\PhysicalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/physical")
 */
class PhysicalController extends AbstractController
{
    /**
     * @Route("/", name="physical_index", methods="GET")
     */
    public function index(PhysicalRepository $physicalRepository): Response
    {
        return $this->render('physical/index.html.twig', ['physicals' => $physicalRepository->findAll()]);
    }

    /**
     * @Route("/new", name="physical_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $physical = new Physical();
        $form = $this->createForm(PhysicalType::class, $physical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($physical);
            $em->flush();

            return $this->redirectToRoute('physical_index');
        }

        return $this->render('physical/new.html.twig', [
            'physical' => $physical,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="physical_show", methods="GET")
     */
    public function show(Physical $physical): Response
    {
        return $this->render('physical/show.html.twig', ['physical' => $physical]);
    }

    /**
     * @Route("/{id}/edit", name="physical_edit", methods="GET|POST")
     */
    public function edit(Request $request, Physical $physical): Response
    {
        $form = $this->createForm(PhysicalType::class, $physical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('physical_index', ['id' => $physical->getId()]);
        }

        return $this->render('physical/edit.html.twig', [
            'physical' => $physical,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="physical_delete", methods="DELETE")
     */
    public function delete(Request $request, Physical $physical): Response
    {
        if ($this->isCsrfTokenValid('delete'.$physical->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($physical);
            $em->flush();
        }

        return $this->redirectToRoute('physical_index');
    }
}
