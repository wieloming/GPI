<?php

namespace GPI\CoreBundle\Model\Service;

use GPI\CoreBundle\Model\Auction\AddNewAuctionCommand;
use GPI\CoreBundle\Model\Auction\UpdateAuctionCommand;
use GPI\CoreBundle\Model\Calendar\Calendar;

class Auction
{
    private $calendar;
    private $allowedTimePeriods;

    public function __construct(Calendar $calendar, array $allowedTimePeriods)
    {
        $this->calendar = $calendar;
        $this->allowedTimePeriods = $allowedTimePeriods;
    }

    public function createNewAuction(AddNewAuctionCommand $command)
    {
        $dateTimeNow = $this->calendar->dateTimeNow();

        $timePeriod = $command->getTimePeriod();
        if (!in_array($timePeriod, $this->allowedTimePeriods)) {
            throw new \InvalidArgumentException('Time period not allowed.');
        }
        $dateTimeAuctionEnd = $this->calendar->dateTimeInNDays($timePeriod);

        $auction = new \GPI\AuctionBundle\Entity\Auction(
            $dateTimeAuctionEnd,
            $command->getName(),
            $command->getContent(),
            $command->getCategories()
        );
        $auction->setStartTime($dateTimeNow);
        $auction->setMaxPrice($command->getMaxPrice());
        foreach ($command->getDocuments() as $document) {
            $auction->getDocuments()->add($document);
            $document->upload();
        }
        return $auction;
    }

    public function editAuction(UpdateAuctionCommand $command, \GPI\AuctionBundle\Entity\Auction $auction){

        $auction->setName($command->getName());
        $auction->setContent($command->getContent());
        $auction->setCategories($command->getCategories());

        foreach ($command->getDocuments() as $document) {
            $auction->getDocuments()->add($document);
        }

        return $auction;
    }
}