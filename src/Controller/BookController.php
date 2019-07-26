<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
  /**
   * @Route("/book/{id}", name="book_room")
   * @param Request $request
   * @return Response
   */
  public function index(Request $request)
  {

    dump($request->query);

    return $this->render('book/index.html.twig', [

    ]);
  }
}
