<?php

namespace GPI\CoreBundle\Model\Auction;

use Application\Sonata\ClassificationBundle\Entity\Category;
use GPI\AuctionBundle\Entity\Document;
use GPI\CoreBundle\Model\Calendar\Calendar;
use Symfony\Component\Validator\Constraints as Assert;

class Auction
{
    const MAX_FILES = 20;

    protected $status;
    protected $name;
    protected $content;
    protected $documents;
    protected $endTime;
    private $calendar;
    protected $categories;

    public function __construct(\DateTime $endTime, $name, $content, $categories, Calendar $calendar = null)
    {
        $this->status = AuctionStatus::ACTIVE;

        $this->setEndTime($endTime);
        $this->setName($name);
        $this->setContent($content);
        foreach ($categories as $category) {
            $this->addCategory($category);
        }
        if ($calendar !== null) {
            $this->calendar = $calendar;
        } else {
            $this->calendar = new Calendar();
        }
    }

    protected function setCategories(Category $categories)
    {
        $this->categories = $categories;
    }

    public function setEndTime(\DateTime $endTime)
    {
        $this->endTime = $endTime;
    }

    public function isCanceled()
    {
        return $this->status === AuctionStatus::CANCELED;
    }

    public function isActive()
    {
        if ($this->endTime < $this->calendar->dateTimeNow()) {
            return false;
        }
        return $this->status === AuctionStatus::ACTIVE;
    }

    public function cancel()
    {
        $this->status = AuctionStatus::CANCELED;
    }

    public function deactivate()
    {
        $this->status = AuctionStatus::DEACTIVATED;
    }

    public function addDocument(Document $document)
    {
        $this->documents[] = $document;
    }

    public function addCategory(Category $category)
    {
        $this->categories[] = $category;
    }

    public function removeDocument($document)
    {
        // TODO: zrobić!
    }

    public function setName($name)
    {
        if ($name === null) {
            throw new \InvalidArgumentException('Auction name cannot be null.');
        }
        if ($name === '') {
            throw new \InvalidArgumentException('Auction name cannot be empty.');
        }
        $this->name = $name;
        return $this;
    }

    public function getMainPhoto()
    {
        if (!$this->getDocuments()->isEmpty()) {
            return $this->getDocuments()->get(0)->getWebPath();
        } else {
            return "/uploads/documents/default.jpg";
        }
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param mixed $documents
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;
    }



    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setContent($content)
    {
        if ($content === null) {
            throw new \InvalidArgumentException('Auction content cannot be null.');
        }
        if ($content === '') {
            throw new \InvalidArgumentException('Auction content cannot be empty.');
        }
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get content short
     *
     * @return string
     */
    public function getContentShort()
    {
        $maxLength = 30;
        $string = strip_tags($this->content);
        return (strlen($string) > $maxLength) ? substr($string, 0, $maxLength) . '...' : $string;
    }
}