<?php

namespace Eeemarv\EeemarvBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Translatable\Translatable;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @Gedmo\Tree(type="nested") 
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Eeemarv\EeemarvBundle\Repository\CategoryRepository")
 * @Gedmo\TranslationEntity(class="Eeemarv\EeemarvBundle\Entity\CategoryTranslation") 
 */
class Category implements Translatable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id = null;
    
 	/**
 	 * @Gedmo\Translatable
	 * @ORM\Column(type="string")
	 */
	protected $name;   
    
    
    
    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer", name="lft")
     */
    private $left;

    /**
     * @Gedmo\TreeRight 
     * @ORM\Column(type="integer", name="rght")
     */
    private $right;

    /**
     * @Gedmo\TreeParent 
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $parent;

    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(type="integer", nullable=true)
     */
    private $root = null;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer", name="lvl")
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"left"="ASC"})
     */
    private $children;


	/**
	 * @ORM\OneToMany(targetEntity="Message", mappedBy="category")
	 */
	protected $messages;

	/**
	 * @ORM\Column(type="integer", name="message_count")
	 */
	protected $messageCount = 0;
	
	/**
	 * @ORM\Column(type="integer", name="offer_count")
	 */
	protected $offerCount = 0;	
	
	/**
	 * @ORM\Column(type="integer", name="want_count")
	 */
	protected $wantCount = 0;

	/**
	 * @ORM\Column(type="boolean", name="is_commentable", nullable=true)
	 */
	protected $isCommentable;
	
/* */

	/**
	 * @ORM\Column(type="boolean", name="is_wantable", nullable=true)
	 */
	protected $isWantable = false;
	
	/**
	 * @ORM\Column(type="boolean", name="is_offerable", nullable=true)
	 */
	protected $isOfferable = false;
	
	/**
	 * @ORM\Column(type="boolean", name="is_eventable", nullable=true)
	 */
	protected $isEventable = false;

/** mailing list **/ 
	
	/**
	 * ORM\Column(name="email_address", nullable=true)
	 * 
	 * domain not included 
	 *
	protected $emailAddress;
	
				
	
/* Created / Updated */

	/**
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime", name="created_at", nullable=true)
	 */
	protected $createdAt = null;

	/**
	 * @Gedmo\Blameable(on="create")
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="created_by", nullable=true)
	 */
	protected $createdBy = null;

	/**
	 * @Gedmo\Timestampable(on="update")
	 * @ORM\Column(type="datetime", name="updated_at", nullable=true)
	 */
	protected $updatedAt = null;
		
	/**
	 * @Gedmo\Blameable(on="update")
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="updated_by", nullable=true)
	 */
	protected $updatedBy = null;	

/**/

    /**
     * @Gedmo\Locale
     */
    private $locale;


    /**
	* @ORM\OneToMany(targetEntity="CategoryTranslation", mappedBy="object", cascade={"persist", "remove"})
	*/
    private $translations;



    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->translations = new ArrayCollection();       
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set left
     *
     * @param integer $left
     * @return Category
     */
    public function setLeft($left)
    {
        $this->left = $left;
    
        return $this;
    }

    /**
     * Get left
     *
     * @return integer 
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Set right
     *
     * @param integer $right
     * @return Category
     */
    public function setRight($right)
    {
        $this->right = $right;
    
        return $this;
    }

    /**
     * Get right
     *
     * @return integer 
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Set root
     *
     * @param integer $root
     * @return Category
     */
    public function setRoot($root)
    {
        $this->root = $root;
    
        return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return Category
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set messageCount
     *
     * @param integer $messageCount
     * @return Category
     */
    public function setMessageCount($messageCount)
    {
        $this->messageCount = $messageCount;
    
        return $this;
    }

    /**
     * Get messageCount
     *
     * @return integer 
     */
    public function getMessageCount()
    {
        return $this->messageCount;
    }

    /**
     * Set wantCount
     *
     * @param integer $wantCount
     * @return Category
     */
    public function setWantCount($wantCount)
    {
        $this->wantCount = $wantCount;
    
        return $this;
    }

    /**
     * Get wantCount
     *
     * @return integer 
     */
    public function getWantCount()
    {
        return $this->wantCount;
    }

    /**
     * Set offerCount
     *
     * @param integer $offerCount
     * @return Category
     */
    public function setOfferCount($offerCount)
    {
        $this->offerCount = $offerCount;
    
        return $this;
    }

    /**
     * Get offerCount
     *
     * @return integer 
     */
    public function getOfferCount()
    {
        return $this->offerCount;
    }


    /**
     * Set parent
     *
     * @param Eeemarv\EeemarvBundle\Entity\Category $parent
     * @return Category
     */
    public function setParent(\Eeemarv\EeemarvBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return Eeemarv\EeemarvBundle\Entity\Category 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param Eeemarv\EeemarvBundle\Entity\Category $children
     * @return Category
     */
    public function addChildren(\Eeemarv\EeemarvBundle\Entity\Category $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param Eeemarv\EeemarvBundle\Entity\Category $children
     */
    public function removeChildren(\Eeemarv\EeemarvBundle\Entity\Category $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add translations
     *
     * @param Eeemarv\EeemarvBundle\Entity\CategoryTranslation $translations
     * @return Category
     */
    public function addTranslation(\Eeemarv\EeemarvBundle\Entity\CategoryTranslation $translation)
    {
         if (!$this->translations->contains($translation)) {
            $this->translations[] = $translation;
            $t->setObject($this);
        }

        return $this;
    }

    /**
     * Remove translations
     *
     * @param Eeemarv\EeemarvBundle\Entity\CategoryTranslation $translations
     */
    public function removeTranslation(\Eeemarv\EeemarvBundle\Entity\CategoryTranslation $translations)
    {
        $this->translations->removeElement($translations);
    }

    /**
     * Get translations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Add messages
     *
     * @param Eeemarv\EeemarvBundle\Entity\Message $messages
     * @return Category
     */
    public function addMessage(\Eeemarv\EeemarvBundle\Entity\Message $messages)
    {
        $this->messages[] = $messages;
    
        return $this;
    }

    /**
     * Remove messages
     *
     * @param Eeemarv\EeemarvBundle\Entity\Message $messages
     */
    public function removeMessage(\Eeemarv\EeemarvBundle\Entity\Message $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Get messages
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMessages()
    {
        return $this->messages;
    }


    /**
     * Add children
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Category $children
     * @return Category
     */
    public function addChild(\Eeemarv\EeemarvBundle\Entity\Category $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Category $children
     */
    public function removeChild(\Eeemarv\EeemarvBundle\Entity\Category $children)
    {
        $this->children->removeElement($children);
    }
 
 
  
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Category
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    
     /**
     * Set createdBy
     *
     * @param Eeemarv\EeemarvBundle\Entity\User $createdBy
     * @return Category
     */
    public function setCreatedBy(\Eeemarv\EeemarvBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;
    
        return $this;
    }

    /**
     * Get createdBy
     *
     * @return Eeemarv\EeemarvBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }


    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Category
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    /**
     * Set updatedBy
     *
     * @param Eeemarv\EeemarvBundle\Entity\User $updatedBy
     * @return Category
     */
    public function setUpdatedBy(\Eeemarv\EeemarvBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;
    
        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return Eeemarv\EeemarvBundle\Entity\User 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
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
 
     public function __toString()
    {		
        return $this->getName();
    }    
    
     public function getIdentedName()
    {		
        return str_repeat('......', $this->getLevel()) . $this->getName();
    }       

    /**
     * Set isCommentable
     *
     * @param boolean $isCommentable
     * @return Category
     */
    public function setIsCommentable($isCommentable)
    {
        $this->isCommentable = $isCommentable;
    
        return $this;
    }

    /**
     * Get isCommentable
     *
     * @return boolean 
     */
    public function getIsCommentable()
    {
        return $this->isCommentable;
    }

    /**
     * Set isWantable
     *
     * @param boolean $isWantable
     * @return Category
     */
    public function setIsWantable($isWantable)
    {
        $this->isWantable = $isWantable;
    
        return $this;
    }

    /**
     * Get isWantable
     *
     * @return boolean 
     */
    public function getIsWantable()
    {
        return $this->isWantable;
    }

    /**
     * Set isOfferable
     *
     * @param boolean $isOfferable
     * @return Category
     */
    public function setIsOfferable($isOfferable)
    {
        $this->isOfferable = $isOfferable;
    
        return $this;
    }

    /**
     * Get isOfferable
     *
     * @return boolean 
     */
    public function getIsOfferable()
    {
        return $this->isOfferable;
    }

    /**
     * Set isEventable
     *
     * @param boolean $isEventable
     * @return Category
     */
    public function setIsEventable($isEventable)
    {
        $this->isEventable = $isEventable;
    
        return $this;
    }

    /**
     * Get isEventable
     *
     * @return boolean 
     */
    public function getIsEventable()
    {
        return $this->isEventable;
    }
}
