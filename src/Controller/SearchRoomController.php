<?php

namespace App\Controller;

use App\Form\SearchRoomType;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchRoomController extends AbstractController
{
  /**
   * @Route("/search", name="search_room")
   * @param Request $request
   * @param RoomRepository $repository
   * @return Response
   */
  public function index(Request $request, RoomRepository $repository)
  {
    $form = $this->createForm(SearchRoomType::class);

    $form->handleRequest($request);

    $searchResult = [];
    if($form->isSubmitted() && $form->isValid()){
      $searchResult = $repository->getAvailability($form->getData());
      dump($form);
    }

    return $this->render('search_room/index.html.twig', [
      'form' => $form->createView(),
      'rooms' => $searchResult
    ]);
  }
}
