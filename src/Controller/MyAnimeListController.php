<?php

namespace App\Controller;

use App\Entity\MyAnimeList;
use App\Entity\Notes;
use App\Form\MyAnimeListType;
use App\Repository\MyAnimeListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/my/anime/list")
 */
class MyAnimeListController extends AbstractController
{
    /**
     * @Route("/", name="my_anime_list_index", methods={"GET"})
     */
    public function index(MyAnimeListRepository $myAnimeListRepository): Response
    {
        return $this->render(
            'my_anime_list/index.html.twig', [
            'my_anime_lists' => $myAnimeListRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="my_anime_list_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $myAnimeList = new MyAnimeList();
        $form = $this->createForm(MyAnimeListType::class, $myAnimeList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notes = new Notes();
            $entityManager = $this->getDoctrine()->getManager();
            $myAnimeList->setUser($this->getUser());
            $entityManager->persist($myAnimeList);
            $entityManager->flush();

            return $this->redirectToRoute('my_anime_list_index');
        }

        return $this->render(
            'my_anime_list/new.html.twig', [
            'my_anime_list' => $myAnimeList,
            'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="my_anime_list_show", methods={"GET"})
     */
    public function show(MyAnimeList $myAnimeList): Response
    {
        return $this->render(
            'my_anime_list/show.html.twig', [
            'my_anime_list' => $myAnimeList,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="my_anime_list_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MyAnimeList $myAnimeList): Response
    {
        $form = $this->createForm(MyAnimeListType::class, $myAnimeList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('my_anime_list_index');
        }

        return $this->render(
            'my_anime_list/edit.html.twig', [
            'my_anime_list' => $myAnimeList,
            'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="my_anime_list_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MyAnimeList $myAnimeList): Response
    {
        if ($this->isCsrfTokenValid('delete'.$myAnimeList->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($myAnimeList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('my_anime_list_index');
    }
}
