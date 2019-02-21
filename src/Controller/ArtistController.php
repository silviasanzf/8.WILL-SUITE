<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ValidationType;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Project;
use App\Form\ArtistProjectType;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/artist")
 */
class ArtistController extends AbstractController
{
    /**
     * @Route("/profil", name="profil_artist_show", methods="GET")
     */
    public function show(): Response
    {
        $artist = $this->getUser();

        if ($artist->getProgress() == 100) {
            return $this->render('artist/show.html.twig', ['artist' => $artist]);
        } else {
            if ($artist->getProgress() == 0) {
                return $this->redirectToRoute('apply_home', [
                ]);
            }
            if ($artist->getProgress() == 10) {
                return $this->redirectToRoute('apply_Experience', [
                    'role' => $artist->getRoles()[0],
                ]);
            }
            if ($artist->getProgress() == 20) {
                return $this->redirectToRoute('apply_Physical', [
                    'role' => $artist->getRoles()[0],
                ]);
            }
            if ($artist->getProgress() == 30) {
                return $this->redirectToRoute('apply_Actor', [
                    'role' => $artist->getRoles()[0],
                ]);
            }
            if ($artist->getProgress() == 40) {
                return $this->redirectToRoute('apply_upload_photo', [
                    'role' => $artist->getRoles()[0],
                ]);
            }

            if ($artist->getProgress() == 50) {
                return $this->redirectToRoute('apply_upload_document', [
                    'role' => $artist->getRoles()[0],
                ]);
            }
            if ($artist->getProgress() == 60) {
                return $this->redirectToRoute('apply_id_video', [
                    'role' => $artist->getRoles()[0],
                ]);
            }
            if ($artist->getProgress() == 70) {
                return $this->redirectToRoute('apply_on_hold', [
                    'role' => $artist->getRoles()[0],
                ]);
            }
        }
    }

    /**
     * @Route("/castings", name="artist_show_castings", methods="GET|POST")
     */
    public function listCasting(ProjectRepository $projectRepository): Response
    {
        $artist = $this->getUser();
        $projects = $projectRepository->findAll();

        return $this->render('artist/castings.html.twig', [
            'artist' => $artist,
            'projects' => $projects,
        ]);
    }

    /**
     * @Route("/casting/{id}/apply", name="artist_apply_casting", methods="GET|POST", requirements={"id"="\d+"})
     */
    public function apply(Project $project, \Swift_Mailer $mailer): Response
    {
        $artist = $this->getUser();
        $artist->addCasting($project);
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $message = (
        new \Swift_Message(
            $artist->getFirstName() . ' ' . $artist->getBirthName() . ' a postulé pour ' . $project->getTitle()
        )
        )
            ->setFrom($this->getParameter('mail.from'))
            ->setTo($this->getParameter('mail.to'))
            ->setContentType('text/html')
            ->setBody($this->renderView('email/application.html.twig', [
                'artist' => $artist,
                'project' => $project
            ]));
        $mailer->send($message);

        return $this->redirectToRoute('artist_show_castings', [
            'artist' => $artist,
        ]);
    }

    /**
     * @Route("/casting/{id}/cancelApply", name="artist_cancel_apply", methods="GET|POST", requirements={"id"="\d+"})
     */
    public function cancelApply(Project $project): Response
    {
        $artist = $this->getUser();
        $artist->removeCasting($project);
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('artist_show_castings', [
            'artist' => $artist,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="artist_edit", methods="GET|POST")
     */
    public function edit(
        Request $request,
        Artist $artist
    ): Response {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artist_index', ['id' => $artist->getId()]);
        }

        return $this->render('artist/edit.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**

    /**
     * @Route("/{id}/desactiver", name="artist_notactif", methods="GET|POST")
     */
    public function isNotActif(
        \Swift_Mailer $mailer
    ): Response {

        $artist = $this->getUser();
        $artist->getId();
        $artist->setIsactif(false);
        $this->getDoctrine()->getManager()->flush();

        $message = (new \Swift_Message('Un membre de la base vient de désactiver son profil'))
            ->setFrom($this->getParameter('mail.from'))
            ->setTo($this->getParameter('mail.to'))
            ->setContentType('text/html')
            ->setBody($this->renderView('email/info_desactivation_profil.html.twig', [
                'artist' => $artist,
            ]));
        $mailer->send($message);

        return $this->redirectToRoute('logout');
    }

    /**
     * @Route("/reactiver", name="reactivate", methods="GET|POST")
     */
    public function reActivate(
        TranslatorInterface $translator,
        \Swift_Mailer $mailer
    ): Response {

        $artist = $this->getUser();
        $artist->getId();
        $artist->setIsactif(true);
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash(
            'success',
            $translator->trans('message_artiste_reactivate')
        );

        $message = (new \Swift_Message('Un membre inactif vient de résactiver son profil'))
            ->setFrom($this->getParameter('mail.from'))
            ->setTo($this->getParameter('mail.to'))
            ->setContentType('text/html')
            ->setBody($this->renderView('email/info_reactivation_profil.html.twig', [
                'artist' => $artist,
            ]));
        $mailer->send($message);


        return $this->render('artist/show.html.twig', ['artist' => $artist]);
    }

    /**
     * @Route("/projet/{id}", name="project_show_artist", methods="GET|POST")
     */
    public function showProject(Project $project, Request $request): Response
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
}
