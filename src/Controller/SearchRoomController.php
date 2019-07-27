<?php

namespace App\Controller;

use App\Form\SearchRoomType;
use App\Repository\BookingRepository;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchRoomController extends AbstractController
{
  /**
   * @Route("/", name="search")
   * @Route("/search", name="search_room")
   * @param Request $request
   * @param RoomRepository $roomRepository
   * @param BookingRepository $bookingRepository
   * @return Response
   */
  public function index(Request $request, RoomRepository $roomRepository, BookingRepository $bookingRepository)
  {
    $form = $this->createForm(SearchRoomType::class);

    $form->handleRequest($request);

    /**
     * This is the SQL this whole stuff is trying to perform :
     * select r.*, h.* from rooms r
     * where r.capacity >= :nbOfGuests
     * inner join hotels h on h.id = r.hotel_id
     * where r.id not in
     * (
     *    select b.room_id from booking b
     *    where b.arrival_date between :from and :to
     *    or b.departure_date between :from and :to
     * )
     */

    $searchResult = [];
    if($form->isSubmitted() && $form->isValid()){
      $searchData = $form->getData();
      $booked = $bookingRepository->getBooked($searchData);
      $searchResult = $roomRepository->getAvailable($searchData, $booked);
    }

    return $this->render('search_room/index.html.twig', [
      'form' => $form->createView(),
      'rooms' => $searchResult
    ]);
  }
}
