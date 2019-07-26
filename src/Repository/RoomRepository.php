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
    $fromDate = date_format($search["arrivalDate"],"Y-m-d");
    $toDate = date_format($search["departureDate"],"Y-m-d");
    $guests = $search["numberOfGuests"];

    $qb1 = $this->createQueryBuilder("booking")
      ->select("booking.room")
      ->orWhere("booking.arrivalDate between :from and :to")
      ->orWhere("booking.departureDate between :from and :to")
      ->setParameter("from", $fromDate)
      ->setParameter("to", $toDate)
    ;

    $qb2 = $this->createQueryBuilder("room");
    $qb2
      ->select("room")
      ->join("room.hotel","hotel")
      ->andWhere("room.capacity >= :guests")
      ->setParameter("guests", $guests)
      ->andWhere($qb2->expr()->notIn("id", $qb1->getDQL()))
    ;

    return $qb2->getQuery()->getResult();
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
