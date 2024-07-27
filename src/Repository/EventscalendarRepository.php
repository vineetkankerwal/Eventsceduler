<?php
// src/Repository/EventRepository.php

namespace App\Repository;

use App\Entity\EventDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EventscalendarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventDetails::class);
    }

    /**
     * @param \DateTime $date
     * @return EventDetails[]
     */
    public function findByDate(\DateTime $date): array
    {
        $qb = $this->createQueryBuilder('e')
            ->where('e.date = :StartDate')
            ->setParameter('date', $date->format('Y-m-d'));

        return $qb->getQuery()->getResult();
    }
}
