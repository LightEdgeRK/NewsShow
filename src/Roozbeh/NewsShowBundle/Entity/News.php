<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roozbeh
 * Date: 5/24/13
 * Time: 12:38 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Roozbeh\NewsShowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="News")
 */
class News {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $NID;

    /**
     * @ORM\Column(type="string", length=120)
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     */
    protected $summary;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $imgLink;

    /**
     * @ORM\Column(type="text")
     */
    protected $text;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_time;


    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="newsItems")
     * @ORM\JoinColumn(name="GID", referencedColumnName="GID")
     */
    protected $category;




    /**
     * Get NID
     *
     * @return integer 
     */
    public function getNID()
    {
        return $this->NID;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return News
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    
        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set imgLink
     *
     * @param string $imgLink
     * @return News
     */
    public function setImgLink($imgLink)
    {
        $this->imgLink = $imgLink;
    
        return $this;
    }

    /**
     * Get imgLink
     *
     * @return string 
     */
    public function getImgLink()
    {
        return $this->imgLink;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return News
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set date_time
     *
     * @param \DateTime $dateTime
     * @return News
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
     * Set category
     *
     * @param \Roozbeh\NewsShowBundle\Entity\Category $category
     * @return News
     */
    public function setCategory(\Roozbeh\NewsShowBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Roozbeh\NewsShowBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}