<?php

namespace App\Repository;

use App\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomRepository extends ServiceEntityRepository
{
  public function __construct(RegistryInterface $registry)
  {
    parent::__construct($registry, Room::class);
  }

  /**
   * Return a list of available rooms
   * for the search criteria (dates and number of guests)
   * @param $search
   * @return mixed
   */
  public function getAvailability($search)
  {
    $fromDate = $search["arrivalDate"];
    $toDate = $search["departureDate"];
    $guests = $search["numberOfGuests"];

    // search for a room
    // with a capacity superior or equal to the number of guest
    // and with compatible dates
    $qb = $this->createQueryBuilder("room")
      ->select("room")
      ->andWhere("room.capacity >= :guests")
      ->setParameter("guests", $guests)
      ->join("room.hotel", "hotel")
      ->leftJoin("room.bookings","b")
      ->andWhere("b.arrivalDate not between :from and :to")
      ->andWhere("b.departureDate not between :from and :to")
      ->andWhere(":from not between b.arrivalDate and b.departureDate")
      ->setParameter("from", $fromDate)
      ->setParameter("to", $toDate)
      ->orderBy("hotel.name")
    ;

    return $qb->getQuery()->getResult();
  }

  // /**
  //  * @return Room[] Returns an array of Room objects
  //  */
  /*
  public function findByExampleField($value)
  {
      return $this->createQueryBuilder('r')
          ->andWhere('r.exampleField = :val')
          ->setParameter('val', $value)
          ->orderBy('r.id', 'ASC')
          ->setMaxResults(10)
          ->getQuery()
          ->getResult()
      ;
  }
  */

  /*
  public function findOneBySomeField($value): ?Room
  {
      return $this->createQueryBuilder('r')
          ->andWhere('r.exampleField = :val')
          ->setParameter('val', $value)
          ->getQuery()
          ->getOneOrNullResult()
      ;
  }
  */
}
