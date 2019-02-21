<?php

namespace App\Controller;

use App\Entity\TextureHair;
use App\Form\TextureHairType;
use App\Repository\TextureHairRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/texture/hair")
 */
class TextureHairController extends AbstractController
{
    /**
     * @Route("/", name="texture_hair_index", methods="GET")
     */
    public function index(TextureHairRepository $textureHairRepository): Response
    {
        return $this->render('texture_hair/index.html.twig', ['texture_hairs' => $textureHairRepository->findAll()]);
    }

    /**
     * @Route("/new", name="texture_hair_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $textureHair = new TextureHair();
        $form = $this->createForm(TextureHairType::class, $textureHair);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($textureHair);
            $em->flush();

            return $this->redirectToRoute('texture_hair_index');
        }

        return $this->render('texture_hair/new.html.twig', [
            'texture_hair' => $textureHair,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="texture_hair_show", methods="GET")
     */
    public function show(TextureHair $textureHair): Response
    {
        return $this->render('texture_hair/show.html.twig', ['texture_hair' => $textureHair]);
    }

    /**
     * @Route("/{id}/edit", name="texture_hair_edit", methods="GET|POST")
     */
    public function edit(Request $request, TextureHair $textureHair): Response
    {
        $form = $this->createForm(TextureHairType::class, $textureHair);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('texture_hair_index', ['id' => $textureHair->getId()]);
        }

        return $this->render('texture_hair/edit.html.twig', [
            'texture_hair' => $textureHair,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="texture_hair_delete", methods="DELETE")
     */
    public function delete(Request $request, TextureHair $textureHair): Response
    {
        if ($this->isCsrfTokenValid('delete'.$textureHair->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($textureHair);
            $em->flush();
        }

        return $this->redirectToRoute('texture_hair_index');
    }
}
