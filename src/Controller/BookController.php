<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Room;
use App\Form\BookingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
  /**
   * @Route("/book/{id}", name="book_room")
   * @param Request $request
   * @param Room $room
   * @param EntityManagerInterface $manager
   * @return Response
   * @throws \Exception
   */
  public function index(Request $request, Room $room, EntityManagerInterface $manager)
  {

    $booking = new Booking();

    // get the dates and number of guests from the query string bag
    $from = $request->query->get("from");
    $to = $request->query->get("to");
    $guests = $request->query->get("guests");

    // build the booking form
    // passing known data in the options array
    $form = $this->createForm(BookingType::class, $booking,
      [
        "from" => new \DateTime($from),
        "to" => new \DateTime($to),
        "guests" => $guests
      ]
    );

    $form->handleRequest($request);

    // submitting a new booking ?
    if ($form->isSubmitted() && $form->isValid()) {

      // hydrate Booking entity from the request and form data
      $booking = $form->getData();
      $booking->setRoom($room);

      // persist booking and guest
      $manager->persist($booking);
      $manager->flush();

      // return to search page
      return $this->redirectToRoute("search_room");
    }

    return $this->render('book/index.html.twig', [
      'hotel' => $room->getHotel()->getName(),
      'form' => $form->createView()
    ]);
  }

}
