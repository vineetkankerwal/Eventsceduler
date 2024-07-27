<?php
// src/Repository/EventRepository.php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Event;
use App\Entity\EventDetails;

class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventDetails::class);
    }

    public function findByDate($date)
    {
        return $this->createQueryBuilder('e')
            ->where('e.StartDate <= :date')
            ->andWhere('e.EndDate >= :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
    }
}


