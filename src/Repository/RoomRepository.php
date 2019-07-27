<?php

namespace App\Repository;

use App\Entity\Booking;
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

  public function getAvailable($search, $booked)
  {

    // get the criteria from the search form
    $guests = $search["numberOfGuests"];

    // build an array out of the funky booked result
    $bookedRooms = [];
    foreach ($booked as $bookedArray)
    {
      foreach($bookedArray as $item => $value)
      {
        array_push($bookedRooms, $value);
      }
    }

    $qb = $this->createQueryBuilder("room");
    $qb
      ->select("room")
      ->join("room.hotel","hotel")
      ->andWhere("room.capacity >= :guests")
      ->setParameter("guests", $guests)
      ->andWhere($qb->expr()->notIn("room.id", $bookedRooms))
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
