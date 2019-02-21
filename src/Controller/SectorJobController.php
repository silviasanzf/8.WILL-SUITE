<?php

namespace App\Controller;

use App\Entity\SectorJob;
use App\Form\SectorJobType;
use App\Repository\SectorJobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sector/job")
 */
class SectorJobController extends AbstractController
{
    /**
     * @Route("/", name="sector_job_index", methods="GET")
     */
    public function index(SectorJobRepository $sectorJobRepository): Response
    {
        return $this->render('sector_job/index.html.twig', ['sector_jobs' => $sectorJobRepository->findAll()]);
    }

    /**
     * @Route("/new", name="sector_job_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $sectorJob = new SectorJob();
        $form = $this->createForm(SectorJobType::class, $sectorJob);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sectorJob);
            $em->flush();

            return $this->redirectToRoute('sector_job_index');
        }

        return $this->render('sector_job/new.html.twig', [
            'sector_job' => $sectorJob,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sector_job_show", methods="GET")
     */
    public function show(SectorJob $sectorJob): Response
    {
        return $this->render('sector_job/show.html.twig', ['sector_job' => $sectorJob]);
    }

    /**
     * @Route("/{id}/edit", name="sector_job_edit", methods="GET|POST")
     */
    public function edit(Request $request, SectorJob $sectorJob): Response
    {
        $form = $this->createForm(SectorJobType::class, $sectorJob);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sector_job_index', ['id' => $sectorJob->getId()]);
        }

        return $this->render('sector_job/edit.html.twig', [
            'sector_job' => $sectorJob,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sector_job_delete", methods="DELETE")
     */
    public function delete(Request $request, SectorJob $sectorJob): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sectorJob->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sectorJob);
            $em->flush();
        }

        return $this->redirectToRoute('sector_job_index');
    }
}
