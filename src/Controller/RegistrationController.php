<?php
namespace App\Controller;

use App\Form\ArtistType;
use App\Entity\Artist as User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        LoginFormAuthenticator $authenticator,
        GuardAuthenticatorHandler $guardHandler,
        \Swift_Mailer $mailer
    ) {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')
            or $this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('profil_artist_show');
        }
        // 1) build the form
        $user = new User();
        $form = $this->createForm(ArtistType::class, $user);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $message = (new \Swift_Message('Confirmation de votre adresse mail'))
                ->setFrom($this->getParameter('mail.from'))
                ->setTo($this->getParameter('mail.to'))
                ->setContentType('text/html')
                ->setBody($this->renderView('email/confirmation_email.html.twig'))
            ;
            $mailer->send($message);
            // after validating the user and saving them to the database
            // authenticate the user and use onAuthenticationSuccess on the authenticator
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,          // the User object you just created
                $request,
                $authenticator, // authenticator whose onAuthenticationSuccess you want to use
                'main'          // the name of your firewall in security.yaml
            );
        }
        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
