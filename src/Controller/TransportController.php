<?php

namespace App\Controller;

use App\Entity\Transport;
use App\Form\TransportType;
use App\Repository\TransportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/transport")
 */
class TransportController extends AbstractController
{
    /**
     * @Route("/", name="transport_index", methods="GET")
     */
    public function index(TransportRepository $transportRepository): Response
    {
        return $this->render('transport/index.html.twig', ['transports' => $transportRepository->findAll()]);
    }

    /**
     * @Route("/new", name="transport_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $transport = new Transport();
        $form = $this->createForm(TransportType::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($transport);
            $em->flush();

            return $this->redirectToRoute('transport_index');
        }

        return $this->render('transport/new.html.twig', [
            'transport' => $transport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transport_show", methods="GET")
     */
    public function show(Transport $transport): Response
    {
        return $this->render('transport/show.html.twig', ['transport' => $transport]);
    }

    /**
     * @Route("/{id}/edit", name="transport_edit", methods="GET|POST")
     */
    public function edit(Request $request, Transport $transport): Response
    {
        $form = $this->createForm(TransportType::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transport_index', ['id' => $transport->getId()]);
        }

        return $this->render('transport/edit.html.twig', [
            'transport' => $transport,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transport_delete", methods="DELETE")
     */
    public function delete(Request $request, Transport $transport): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transport->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($transport);
            $em->flush();
        }

        return $this->redirectToRoute('transport_index');
    }
}
