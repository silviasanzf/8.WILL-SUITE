<?php
/**
 * Created by PhpStorm.
 * User: davidlavigne
 * Date: 07/01/2019
 * Time: 15:52
 */

namespace App\Controller;

use App\Entity\ProductionCompagny;
use App\Entity\Project;
use App\Service\Contract;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Entity\Artist;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\ArtistSearch;
use App\Form\ArtistSearchType;
use App\Form\ValidationType;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\ArtistType;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/gestion")
 */
class ManagementController extends AbstractController
{
    protected $requestStack;

    private $artistRepository;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/", name="management_index", methods="GET|POST")
     */
    public function home(): Response
    {
        $artist = $this->getUser();

        return $this->render('management/index.html.twig', array('artist' => $artist));
    }

    /**
     * @Route("/contrat/{artist}/{project}", name="management_contract", methods="GET|POST")
     */
    public function generate(Artist $artist, Project $project, Contract $contract)
    {
        try {
            return $contract->generate($artist, $project);
        } catch (\Exception $e) {
            $this->addFlash('danger', $e);
            return $this->redirectToRoute('management_index');
        }
    }

    /**
     * @Route("/artists", name="artist_index", methods="GET")
     */
    public function index(
        PaginatorInterface $paginator,
        Request $request,
        ArtistRepository $artistRepository
    ): Response {

        $user = $this->getUser();
        $search = new ArtistSearch();
        $form = $this->createForm(ArtistSearchType::class, $search);
        $form->handleRequest($request);

        $this->artistRepository = $artistRepository;
        $artists = $paginator->paginate(
            $this->artistRepository->findByCriteria($search),
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('artist/index.html.twig', [
            'user' => $user,
            'artists' => $artists,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/artist/new", name="artist_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artist);
            $em->flush();

            return $this->redirectToRoute('artist_index');
        }

        return $this->render('artist/new.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("artist/{id}", name="artist_show_admin", methods="GET|POST", requirements={"id"="\d+"})
     */
    public function showAdmin(
        Artist $artist,
        TranslatorInterface $translator,
        Request $request,
        \Swift_Mailer $mailer
    ): Response {
        $user = $this->getUser();
        $form = $this->createForm(ValidationType::class);
        $form->handleRequest($request);
        /**
         * @var \Symfony\Component\Form\SubmitButton $validation
         */
        $validation = $form->get('validation');
        if ($validation->isClicked()) {
            $artist->setProgress(100);

            $message = (new \Swift_Message('Bienvenue chez TheWill !'))
                ->setFrom($this->getParameter('mail.from'))
                ->setTo($artist->getEmail())
                ->setContentType('text/html')
                ->setBody($this->renderView('email/welcome_actor.html.twig', [
                    'artist' => $artist,
                ]))
            ;
            $mailer->send($message);

            $this->addFlash(
                'success',
                $translator->trans('message_artiste_validate')
            );

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('artist_show_admin', ['id' => $artist->getId()]);
        }

        if (in_array('ROLE_ADMIN', $user->getRoles()) or in_array('ROLE_SUPER_ADMIN', $user->getRoles())) {
            return $this->render('artist/show_admin.html.twig', [
                'artist' => $artist,
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/telecharger/administratif/{id}", name="artist_download_admin", methods="GET|POST")
     */
    public function downloadProfilAdmin(Artist $artist)
    {

        $title= $artist->getFirstname();
        $title1=$artist->getMarriedName();
        $tittle2=$artist->getBirthName();

        // Configure Dompdf according to your needs
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new \Dompdf\Dompdf($options);


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('artist/downloadProfilAdmin.html.twig', [
            'title' => "Welcome to our PDF Test",
            'artist' => $artist,
            'dir' => __DIR__ . '/../../public/assets/images/upload/photos/'
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Administratif-".$title.$title1.$tittle2."pdf", [
            "Attachment" => true
        ]);
    }
    /**
     * @Route("/telecharger/physique/{id}", name="artist_download_physical", methods="GET|POST")
     */
    public function downloadProfilPhysical(Artist $artist)
    {

        $title= $artist->getFirstname();
        $title1=$artist->getMarriedName();
        $tittle2=$artist->getBirthName();

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('artist/downloadProfilPhysical.html.twig', [
            'title' => "Welcome to our PDF Test",
            'artist' => $artist,
            'dir' => __DIR__ . '/../../public/assets/images/upload/photos/'
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Physique-".$title.$title1.$tittle2."pdf", [
            "Attachment" => true
        ]);
    }

    /**
     * @Route("/validations", name="validations_index", methods="GET")
     */
    public function listValidations(ArtistRepository $artistRepository): Response
    {
        $artists = $artistRepository->findBy([
            'progress' => 70
        ]);

        return $this->render('management/validations.html.twig', [
            'artists' => $artists,
        ]);
    }

    /**
     * @Route("/application/{artist}/{project}/validation", name="application_validation", methods="GET|POST")
     */
    public function validateApplication(Artist $artist, Project $project, \Swift_Mailer $mailer): Response
    {
        $artist->addProject($project);
        $artist->removeCasting($project);
        $project->addArtist($artist);
        $project->removeCandidate($artist);
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $message = (
        new \Swift_Message(
            'Félicications ! Votre candidature à ' . $project->getTitle() . ' a été retenue !'
        )
        )
            ->setFrom($this->getParameter('mail.from'))
            ->setTo($artist->getEmail())
            ->setContentType('text/html')
            ->setBody($this->renderView('email/application_validation.html.twig', [
                'artist' => $artist,
                'project' => $project
            ]));
        $mailer->send($message);

        $request = $this->requestStack->getCurrentRequest();
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

    /**
     * @Route("/application/{artist}/{project}/denial", name="application_denial", methods="GET|POST")
     */
    public function declineApplication(Artist $artist, Project $project, \Swift_Mailer $mailer): Response
    {
        $artist->removeCasting($project);
        $project->removeCandidate($artist);
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $message = (
        new \Swift_Message(
            'Votre candidature à ' . $project->getTitle()
        )
        )
            ->setFrom($this->getParameter('mail.from'))
            ->setTo($artist->getEmail())
            ->setContentType('text/html')
            ->setBody($this->renderView('email/application_denial.html.twig', [
                'artist' => $artist,
                'project' => $project
            ]));
        $mailer->send($message);

        $request = $this->requestStack->getCurrentRequest();
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }

    /**
     * @Route("/artist/delete/{id}", name="artist_delete", methods="DELETE")
     */
    public function delete(
        Request $request,
        Artist $artist
    ): Response {
        $picture1 = $artist->getPortraitPictureName1();
        $picture2 = $artist->getPortraitPictureName2();
        $picture3 = $artist->getFullPictureName();
        $doc1 = $artist->getCvName();
        $doc2 = $artist->getRibName();
        $doc3 = $artist->getSocialCardName();
        $doc4 = $artist->getIdentityCardName();
        $doc5 = $artist->getResidencePermitName();
        $doc6 = $artist->getCmbName();
        if ($this->isCsrfTokenValid('delete' . $artist->getId(), $request->request->get('_token'))) {
            unlink('../public/assets/images/upload/photos/' . $picture1);
            unlink('../public/assets/images/upload/photos/' . $picture2);
            unlink('../public/assets/images/upload/photos/' . $picture3);
            unlink('../public/assets/images/upload/documents/' . $doc1);
            unlink('../public/assets/images/upload/documents/' . $doc2);
            unlink('../public/assets/images/upload/documents/' . $doc3);
            unlink('../public/assets/images/upload/documents/' . $doc4);
            if (!empty($doc5)) {
                unlink('../public/assets/images/upload/documents/' . $doc5);
            }
            if (!empty($doc6)) {
                unlink('../public/assets/images/upload/documents/' . $doc6);
            }
            /* TODO: vérifer les chemins pour mise en ligne*/

            $em = $this->getDoctrine()->getManager();
            $em->remove($artist);
            $em->flush();
            $this->addFlash(
                'success',
                'Le profil a bien été supprimé.'
            );
        }

        return $this->redirectToRoute('management_index');
    }
}
