<?php

namespace App\Controller;

use App\Entity\ColorHair;
use App\Form\ColorHairType;
use App\Repository\ColorHairRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/color/hair")
 */
class ColorHairController extends AbstractController
{
    /**
     * @Route("/", name="color_hair_index", methods="GET")
     */
    public function index(ColorHairRepository $colorHairRepository): Response
    {
        return $this->render('color_hair/index.html.twig', ['color_hairs' => $colorHairRepository->findAll()]);
    }

    /**
     * @Route("/new", name="color_hair_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $colorHair = new ColorHair();
        $form = $this->createForm(ColorHairType::class, $colorHair);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($colorHair);
            $em->flush();

            return $this->redirectToRoute('color_hair_index');
        }

        return $this->render('color_hair/new.html.twig', [
            'color_hair' => $colorHair,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="color_hair_show", methods="GET")
     */
    public function show(ColorHair $colorHair): Response
    {
        return $this->render('color_hair/show.html.twig', ['color_hair' => $colorHair]);
    }

    /**
     * @Route("/{id}/edit", name="color_hair_edit", methods="GET|POST")
     */
    public function edit(Request $request, ColorHair $colorHair): Response
    {
        $form = $this->createForm(ColorHairType::class, $colorHair);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('color_hair_index', ['id' => $colorHair->getId()]);
        }

        return $this->render('color_hair/edit.html.twig', [
            'color_hair' => $colorHair,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="color_hair_delete", methods="DELETE")
     */
    public function delete(Request $request, ColorHair $colorHair): Response
    {
        if ($this->isCsrfTokenValid('delete'.$colorHair->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($colorHair);
            $em->flush();
        }

        return $this->redirectToRoute('color_hair_index');
    }
}
