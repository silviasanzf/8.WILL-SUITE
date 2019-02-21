<?php

namespace App\Controller;

use App\Entity\DrivingLicence;
use App\Form\DrivingLicenceType;
use App\Repository\DrivingLicenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/driving/licence")
 */
class DrivingLicenceController extends AbstractController
{
    /**
     * @Route("/", name="driving_licence_index", methods="GET")
     */
    public function index(DrivingLicenceRepository $drivingLicenceRepository): Response
    {
        return $this->render(
            'driving_licence/index.html.twig',
            ['driving_licences' => $drivingLicenceRepository->findAll()]
        );
    }

    /**
     * @Route("/new", name="driving_licence_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $drivingLicence = new DrivingLicence();
        $form = $this->createForm(DrivingLicenceType::class, $drivingLicence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($drivingLicence);
            $em->flush();

            return $this->redirectToRoute('driving_licence_index');
        }

        return $this->render('driving_licence/new.html.twig', [
            'driving_licence' => $drivingLicence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="driving_licence_show", methods="GET")
     */
    public function show(DrivingLicence $drivingLicence): Response
    {
        return $this->render('driving_licence/show.html.twig', ['driving_licence' => $drivingLicence]);
    }

    /**
     * @Route("/{id}/edit", name="driving_licence_edit", methods="GET|POST")
     */
    public function edit(Request $request, DrivingLicence $drivingLicence): Response
    {
        $form = $this->createForm(DrivingLicenceType::class, $drivingLicence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('driving_licence_index', ['id' => $drivingLicence->getId()]);
        }

        return $this->render('driving_licence/edit.html.twig', [
            'driving_licence' => $drivingLicence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="driving_licence_delete", methods="DELETE")
     */
    public function delete(Request $request, DrivingLicence $drivingLicence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$drivingLicence->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($drivingLicence);
            $em->flush();
        }

        return $this->redirectToRoute('driving_licence_index');
    }
}
