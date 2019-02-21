<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ProductionCompagny;
use App\Form\ProductionCompagnyType;
use App\Repository\ProductionCompagnyRepository;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @Route("/gestion/production")
 */
class ProductionCompagnyController extends AbstractController
{
    /**
     * @Route("/", name="production_compagny_index", methods="GET")
     */
    public function index(ProductionCompagnyRepository $productionCompagnyRepository): Response
    {
        return $this->render(
            'production_compagny/index.html.twig',
            ['production_compagnies' => $productionCompagnyRepository->findAll()]
        );
    }

    /**
     * @Route("/new", name="production_compagny_new", methods="GET|POST")
     */
    public function new(Request $request, TranslatorInterface $translator): Response
    {
        $productionCompagny = new ProductionCompagny();
        $form = $this->createForm(ProductionCompagnyType::class, $productionCompagny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productionCompagny);
            $em->flush();

            $this->addFlash(
                'success',
                $translator->trans('message_production_create')
            );

            return $this->redirectToRoute('production_compagny_index');
        }

        return $this->render('production_compagny/new.html.twig', [
            'production_compagny' => $productionCompagny,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="production_compagny_show", methods="GET")
     */
    public function show(ProductionCompagny $productionCompagny): Response
    {
        return $this->render('production_compagny/show.html.twig', ['production_compagny' => $productionCompagny]);
    }

    /**
     * @Route("/{id}/edit", name="production_compagny_edit", methods="GET|POST")
     */
    public function edit(
        Request $request,
        ProductionCompagny $productionCompagny,
        TranslatorInterface $translator
    ): Response {
        $form = $this->createForm(ProductionCompagnyType::class, $productionCompagny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'success',
                $translator->trans('message_production_edit')
            );
            return $this->redirectToRoute('production_compagny_index', ['id' => $productionCompagny->getId()]);
        }

        return $this->render('production_compagny/edit.html.twig', [
            'production_compagny' => $productionCompagny,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="production_compagny_delete", methods="DELETE")
     */
    public function delete(Request $request, ProductionCompagny $productionCompagny): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productionCompagny->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productionCompagny);
            $em->flush();
        }

        return $this->redirectToRoute('production_compagny_index');
    }
}
