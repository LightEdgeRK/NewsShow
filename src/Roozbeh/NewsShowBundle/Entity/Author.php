<?php

namespace Roozbeh\NewsShowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Count;


/**
 * Author
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity(fields="username", message="Sorry, this username is already taken.")
 */
class Author implements UserInterface
{
    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {

    }

    /**
     * @var integer
     *
     * @ORM\Column(name="AID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $AID;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=100 )
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=30)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=30)
     */
    private $lastname;

    /**
     * @ORM\ManyToMany(targetEntity="Category",inversedBy="authors")
     * @ORM\JoinTable(name="Author_Category",
     *      joinColumns={@ORM\JoinColumn(name="AID",referencedColumnName="AID")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="GID",referencedColumnName="GID")} )
     * @Count(min = 1, minMessage = "At least one category must be selected")
     */
    protected $categories;

    /**
     * @ORM\OneToMany(targetEntity="News",mappedBy="author")
     */
    protected $newsItems;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Author
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Author
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Author
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Author
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Get AID
     *
     * @return integer 
     */
    public function getAID()
    {
        return $this->AID;
    }

    /**
     * Add categories
     *
     * @param \Roozbeh\NewsShowBundle\Entity\Category $categories
     * @return Author
     */
    public function addCategorie(\Roozbeh\NewsShowBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
    
        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Roozbeh\NewsShowBundle\Entity\Category $categories
     */
    public function removeCategorie(\Roozbeh\NewsShowBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add newsItems
     *
     * @param \Roozbeh\NewsShowBundle\Entity\News $newsItems
     * @return Author
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
}