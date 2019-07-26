<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Room;
use App\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
  /**
   * @Route("/book/{id}", name="book_room")
   * @param Request $request
   * @return Response
   * @throws \Exception
   */
  public function index(Request $request, Room $room)
  {

    $booking = new Booking();

    $from = $request->query->get("from");
    $to = $request->query->get("to");
    $guests = $request->query->get("guests");


    $form = $this->createForm(BookingType::class, $booking,
      [
        "from" => new \DateTime($from),
        "to" => new \DateTime($to),
        "guests" => $guests
      ]
    );

    $form->add('room', HiddenType::class, [ "data" => $room->getId() ]);

    $form->handleRequest($request);

    return $this->render('book/index.html.twig', [
      'hotel' => $room->getHotel()->getName(),
      'form' => $form->createView()
    ]);
  }
}
