<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Project;
use App\Form\ArtistProjectType;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/gestion/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="project_index", methods="GET")
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('project/index.html.twig', ['projects' => $projectRepository->findAll()]);
    }

    /**
     * @Route("/new", name="project_new", methods="GET|POST")
     */
    public function new(Request $request, TranslatorInterface $translator): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $this->addFlash(
                'success',
                $translator->trans('message_project_create')
            );

            return $this->redirectToRoute('project_index');
        }

        return $this->render('project/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="project_show", methods="GET|POST")
     */
    public function show(Project $project, Request $request): Response
    {
        $artist = $this->getUser();

        $form = $this->createForm(ArtistProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidates = (array) $project->getCandidates();
            $artists = $project->getArtists();
            foreach ($artists as $artist) {
                if (in_array($artist, $candidates)) {
                    $project->removeCandidate($artist);
                    $this->getDoctrine()->getManager()->flush();
                }
            }
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('project_show', ['id' => $project->getId()]);
        }


        return $this->render('project/show.html.twig', [
            'project' => $project,
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="project_edit", methods="GET|POST")
     */
    public function edit(Request $request, Project $project, TranslatorInterface $translator): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                $translator->trans('message_project_edit')
            );

            return $this->redirectToRoute('project_index', ['id' => $project->getId()]);
        }

        return $this->render('project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="project_delete", methods="DELETE")
     */
    public function delete(Request $request, Project $project): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('project_index');
    }
}
