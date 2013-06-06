<?php

namespace Roozbeh\NewsShowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Category
{

    public function __toString()
    {
        return $this->name;
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="GID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $GID;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="News",mappedBy="category")
     */
    protected $newsItems;

    /**
     * @ORM\ManyToMany(targetEntity="Author",mappedBy="categories")
     */
    protected $authors;

    public function __construct()
    {
        $this->newsItems = new ArrayCollection();
        $this->authors = new ArrayCollection();
    }

    /**
     * Get GID
     *
     * @return integer
     */
    public function getGID()
    {
        return $this->GID;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
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

    /**
     * Add newsItems
     *
     * @param \Roozbeh\NewsShowBundle\Entity\News $newsItems
     * @return Category
     */
    public function addNewsItem(\Roozbeh\NewsShowBundle\Entity\News $newsItems)
    {
        $this->newsItems[] = $newsItems;
    
        return $this;
    }

    /**
     * Remove newsItems
     *
     * @param \Roozbeh\NewsShowBundle\Entity\News $newsItems
     */
    public function removeNewsItem(\Roozbeh\NewsShowBundle\Entity\News $newsItems)
    {
        $this->newsItems->removeElement($newsItems);
    }

    /**
     * Get newsItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNewsItems()
    {
        return $this->newsItems;
    }

    /**
     * Add authors
     *
     * @param \Roozbeh\NewsShowBundle\Entity\Author $authors
     * @return Category
     */
    public function addAuthor(\Roozbeh\NewsShowBundle\Entity\Author $authors)
    {
        $this->authors[] = $authors;
    
        return $this;
    }

    /**
     * Remove authors
     *
     * @param \Roozbeh\NewsShowBundle\Entity\Author $authors
     */
    public function removeAuthor(\Roozbeh\NewsShowBundle\Entity\Author $authors)
    {
        $this->authors->removeElement($authors);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuthors()
    {
        return $this->authors;
    }
}