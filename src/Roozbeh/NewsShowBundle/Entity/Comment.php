<?php

namespace Roozbeh\NewsShowBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Comment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $CID;

    /**
     * @var string
     *
     * @ORM\Column(name="authorName", type="string", length=30)
     */
    private $authorName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_time", type="datetime")
     */
    private $date_time;

    /**
     * @var string
     *
     * @ORM\Column(name="fulltext", type="text")
     */
    private $fulltext;

    /**
     * @var integer
     *
     * @ORM\Column(name="point", type="integer")
     */
    private $point;


    /**
     * @ORM\ManyToOne(targetEntity="News",inversedBy="comments")
     * @ORM\JoinColumn(name="NID",referencedColumnName="NID")
     */
    protected $newsItem;


    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="parComment")
     */
    protected $subComments;


    /**
     * @ORM\ManyToOne(targetEntity="Comment",inversedBy="subComments")
     * @ORM\JoinColumn(name="CMID" , referencedColumnName="CID")
     */
    protected $parComment;

    public function __construct()
    {
        $this->subComments = new ArrayCollection();
    }

    /**
     * Set authorName
     *
     * @param string $authorName
     * @return Comment
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    
        return $this;
    }

    /**
     * Get authorName
     *
     * @return string 
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Set date_time
     *
     * @param \DateTime $dateTime
     * @return Comment
     */
    public function setDateTime($dateTime)
    {
        $this->date_time = $dateTime;
    
        return $this;
    }

    /**
     * Get date_time
     *
     * @return \DateTime 
     */
    public function getDateTime()
    {
        return $this->date_time;
    }

    /**
     * Set fulltext
     *
     * @param string $fulltext
     * @return Comment
     */
    public function setFulltext($fulltext)
    {
        $this->fulltext = $fulltext;
    
        return $this;
    }

    /**
     * Get fulltext
     *
     * @return string 
     */
    public function getFulltext()
    {
        return $this->fulltext;
    }

    /**
     * Set point
     *
     * @param integer $point
     * @return Comment
     */
    public function setPoint($point)
    {
        $this->point = $point;
    
        return $this;
    }

    /**
     * Get point
     *
     * @return integer 
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Get CID
     *
     * @return integer 
     */
    public function getCID()
    {
        return $this->CID;
    }

    /**
     * Set newsItem
     *
     * @param \Roozbeh\NewsShowBundle\Entity\News $newsItem
     * @return Comment
     */
    public function setNewsItem(\Roozbeh\NewsShowBundle\Entity\News $newsItem = null)
    {
        $this->newsItem = $newsItem;
    
        return $this;
    }

    /**
     * Get newsItem
     *
     * @return \Roozbeh\NewsShowBundle\Entity\News 
     */
    public function getNewsItem()
    {
        return $this->newsItem;
    }

    /**
     * Add subComments
     *
     * @param \Roozbeh\NewsShowBundle\Entity\Comment $subComments
     * @return Comment
     */
    public function addSubComment(\Roozbeh\NewsShowBundle\Entity\Comment $subComments)
    {
        $this->subComments[] = $subComments;
    
        return $this;
    }

    /**
     * Remove subComments
     *
     * @param \Roozbeh\NewsShowBundle\Entity\Comment $subComments
     */
    public function removeSubComment(\Roozbeh\NewsShowBundle\Entity\Comment $subComments)
    {
        $this->subComments->removeElement($subComments);
    }

    /**
     * Get subComments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubComments()
    {
        return $this->subComments;
    }

    /**
     * Set parComment
     *
     * @param \Roozbeh\NewsShowBundle\Entity\Comment $parComment
     * @return Comment
     */
    public function setParComment(\Roozbeh\NewsShowBundle\Entity\Comment $parComment = null)
    {
        $this->parComment = $parComment;
    
        return $this;
    }

    /**
     * Get parComment
     *
     * @return \Roozbeh\NewsShowBundle\Entity\Comment 
     */
    public function getParComment()
    {
        return $this->parComment;
    }
}