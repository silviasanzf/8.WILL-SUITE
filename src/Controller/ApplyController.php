<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 09/01/19
 * Time: 10:56
 */

namespace App\Controller;

use App\Entity\Artist;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ApplyUploadPhotoType;
use App\Service\Link;
use App\Form\ApplyCivilStatusType;
use App\Form\ApplyActorType;
use App\Form\ApplyPhysicalType;
use App\Form\ApplyVideoType;
use App\Form\ApplyExperienceType;
use App\Form\ApplyUploadDocumentType;
use App\Form\SubmitType;

/**
 * @Route("/candidature")
 */
class ApplyController extends AbstractController
{
    /**
     * @Route("/home", name="apply_home", methods="GET|POST")
     */
    public function home(): Response
    {
        $artist = $this->getUser();
        return $this->render('apply/ApplyHome.html.twig', array('artist' => $artist));
    }


    /**
     * @Route("/role/{role}", name="apply_role", methods="GET")
     *
     * @param string $role
     *
     * @return Response
     */
    public function role(string $role): Response
    {
        $artist = $this->getUser();
        $artist->setRoles(['ROLE_' . strtoupper($role)]);
        $artist->setProfessional(($role == 'actor'));
        $artist->setIsActif(true);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('apply_CivilStatus');
    }


    /**
     * @Route("/etat-civil", name="apply_CivilStatus", methods="GET|POST")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function civilStatus(Request $request): Response
    {
        $artist = $this->getUser();
        $form = $this->createForm(ApplyCivilStatusType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($artist->getProgress() != 100) {
                $artist->setProgress(10);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apply_Experience');
        }

        return $this->render('apply/ApplyCivilStatus.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/experience", name="apply_Experience", methods="GET|POST")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function experiences(Request $request): Response
    {
        $artist = $this->getUser();
        $form = $this->createForm(ApplyExperienceType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($artist->getProgress() != 100) {
                $artist->setProgress(20);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apply_Physical');
        }

        return $this->render('apply/ApplyExperience.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/criteres-physiques", name="apply_Physical", methods="GET|POST")
     *
     * @param Request $request
     * @return Response
     */
    public function physical(Request $request): Response
    {
        $artist = $this->getUser();
        $form = $this->createForm(ApplyPhysicalType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($artist->getProgress() != 100) {
                $artist->setProgress(30);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apply_Actor');
        }

        return $this->render('apply/ApplyPhysical.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/acteur", name="apply_Actor", methods="GET|POST")
     *
     * @param Request $request
     * @return Response
     */
    public function actor(Request $request): Response
    {
        $artist = $this->getUser();
        $form = $this->createForm(ApplyActorType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($artist->getProgress() != 100) {
                $artist->setProgress(40);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apply_upload_photo');
        }

        return $this->render('apply/ApplyActor.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/photos", name="apply_upload_photo", methods="GET|POST")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function photos(Request $request): Response
    {
        /**
         * @var Artist $artist
         */
        $artist = $this->getUser();
        $form = $this->createForm(ApplyUploadPhotoType::class, $artist);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            if ($artist->getProgress() != 100) {
                $artist->setProgress(50);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $artist->setPortraitPictureFile1(null);
            $artist->setPortraitPictureFile2(null);
            $artist->setFullPictureFile(null);

            return $this->redirectToRoute('apply_upload_document');
        }

        return $this->render('apply/ApplyUploadPhoto.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/document", name="apply_upload_document", methods="GET|POST")
     */
    public function document(Request $request): Response
    {
        $artist = $this->getUser();
        $form = $this->createForm(ApplyUploadDocumentType::class, $artist);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $artist->setCvFile(null);
            $artist->setRibFile(null);
            $artist->setSocialCardFile(null);
            $artist->setIdentityCardFile(null);
            $artist->setResidencePermitFile(null);
            $artist->setCmbFile(null);

            return $this->redirectToRoute('apply_id_video');
        }

        return $this->render('apply/ApplyUploadDocument.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/video", name="apply_id_video", methods="GET|POST")
     *
     * @param Request $request
     * @param Link $link
     *
     * @return Response
     */
    public function video(Request $request, Link $link, \Swift_Mailer $mailer): Response
    {
        $artist = $this->getUser();
        $form = $this->createForm(ApplyVideoType::class, $artist);
        $form->handleRequest($request);

        $keyLink = null;
        if (null !== $artist->getVideo()) {
            $keyLink = $link->generate($artist->getVideo());
            $artist->setVideo($keyLink);
        }

        /**
         * @var \Symfony\Component\Form\SubmitButton $validationVideo
         */
        $validationVideo = $form->get('validation_video');
        if ($validationVideo->isClicked()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('apply_id_video');
        }

        /**
         * @var \Symfony\Component\Form\SubmitButton $validationProfil
         */
        $validationProfil = $form->get('validation_profil');

        if ($validationProfil->isClicked()) {
            if ($artist->getProgress() == 100) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('profil_artist_show');
            } else {
                if (in_array('ROLE_ACTOR', $artist->getRoles())) {
                    $message = (new \Swift_Message('Un nouvel acteur professionnel a rejoint vos rangs!'))
                        ->setFrom($this->getParameter('mail.from'))
                        ->setTo($this->getParameter('mail.to'))
                        ->setContentType('text/html')
                        ->setBody($this->renderView('email/validation_profil.html.twig', [
                            'artist' => $artist,
                        ]))
                    ;
                    $mailer->send($message);

                    $artist->setProgress(70);
                    $this->getDoctrine()->getManager()->flush();

                    return $this->redirectToRoute('apply_on_hold');
                }
            }
            if (in_array('ROLE_EXTRA', $artist->getRoles())) {
                $message = (new \Swift_Message('Bienvenue chez TheWill !'))
                    ->setFrom($this->getParameter('mail.from'))
                    ->setTo($artist->getEmail())
                    ->setContentType('text/html')
                    ->setBody($this->renderView('email/welcome_extra.html.twig', [
                        'artist' => $artist,
                    ]))
                ;
                $mailer->send($message);

                $message = (
                    new \Swift_Message(
                        $artist->getFirstName() . ' ' . $artist->getBirthName() . ' a rejoint TheWill!'
                    )
                )
                    ->setFrom($this->getParameter('mail.from'))
                    ->setTo($this->getParameter('mail.from'))
                    ->setContentType('text/html')
                    ->setBody($this->renderView('email/new_extra.html.twig', [
                        'artist' => $artist,
                    ]))
                ;
                $mailer->send($message);

                $artist->setProgress(100);
                $this->getDoctrine()->getManager()->flush();
            }
        }

        return $this->render('apply/ApplyVideo.html.twig', [
            'artist' => $artist,
            'keyLink' => $keyLink,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/attente-validation", name="apply_on_hold", methods="GET")
     */
    public function edit(): Response
    {
        $artist = $this->getUser();
        return $this->render('apply/ApplyOnHold.html.twig', [
            'artist' => $artist,
        ]);
    }
}
