<?php

namespace Eeemarv\EeemarvBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="Eeemarv\EeemarvBundle\Repository\MessageRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id = null;

    /**
     * @ORM\Column(type="string", name="unique_id", unique=true)  
     */
    protected $uniqueId;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $subject;
	
	/**
	 * @Gedmo\Slug(fields={"subject"}) 
	 * @ORM\Column(type="string", unique=true)
	 */
	protected $slug;	

	/**
	 * @Assert\NotBlank
	 * @ORM\Column(type="text")
	 */
	protected $content;	


	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	protected $price = null;

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="messages")
	 * @ORM\JoinColumn(name="user_id")
	 */
	protected $user;

	/**
	 * @Assert\NotBlank(groups={"new", "edit"})
	 * @ORM\ManyToOne(targetEntity="Category", inversedBy="messages")
	 * @ORM\JoinColumn(name="category_id")
	 */
	protected $category;


	/**
	 * @ORM\Column(type="datetime", name="event_start_at", nullable=true)
	 */
	protected $eventStartAt = null;

	/**
	 * @ORM\Column(type="datetime", name="event_end_at", nullable=true)
	 */
	protected $eventEndAt = null;

	/**
	 * @ORM\Column(type="boolean", name="is_offer", nullable=true)
	 */
	protected $isOffer;

	/**
	 * @ORM\Column(type="boolean", name="is_want", nullable=true)
	 */
	protected $isWant;


	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $approved = false;

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $archived = false;

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $enabled = false;

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $published = false;



	/**
	 * @ORM\OneToMany(targetEntity="MessageImage", mappedBy="message")
	 */
	protected $images;

	/**
	 * @ORM\OneToMany(targetEntity="Comment", mappedBy="message")
	 */
	protected $comments;
	
	/**
	 * @ORM\Column(type="integer", name="comment_count")
	 */
	protected $commentCount = 0;
	
    /**
     * @ORM\Column(name="last_comment_at", type="datetime", nullable=true)
     */
    protected $lastCommentAt;	

	/**
	 * @ORM\Column(type="boolean", name="is_commentable", nullable=true)
	 */
	protected $isCommentable;

	
	
	/**
	 * @ORM\OneToOne(targetEntity="User", mappedBy="profileMessage")
	 * @ORM\JoinColumn(name="profile_user_id", nullable=true)
	 */ 
	protected $profileUser;	

	/**
	 * @ORM\OneToMany(targetEntity="Transaction", mappedBy="message")
	 */
	protected $transactions;

	/**
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime", name="created_at", nullable=true)
	 */
	protected $createdAt = null;

	/**
	 * @Gedmo\Blameable(on="create")
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="created_by")
	 */
	protected $createdBy;

	/**
	 * @Gedmo\Timestampable(on="update")
	 * @ORM\Column(type="datetime", name="updated_at", nullable=true)
	 */
	protected $updatedAt = null;
		
	/**
	 * @Gedmo\Blameable(on="update")
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="updated_by")
	 */
	protected $updatedBy;

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $deleted = false;

	
    /**
     * @Gedmo\Timestampable(on="change", field="deleted", value=true)
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    protected $deletedAt;
    
	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $valid = true;

	
    /**
     * @Gedmo\Timestampable(on="change", field="valid", value=false)
     * @ORM\Column(name="unvalidated_at", type="datetime", nullable=true)
     */
    protected $unvalidatedAt;    
    

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->transactions = new ArrayCollection();                                          
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
     * Set uniqueId
     *
     * @param string $uniqueId
     * @return User
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;
    
        return $this;
    }

    /**
     * Get uniqueId
     *
     * @return string 
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    } 

    /**
     * Set price
     *
     * @param integer $price
     * @return Message
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }



    /**
     * Set eventStartAt
     *
     * @param \DateTime $eventStartAt
     * @return Message
     */
    public function setEventStartAt($eventStartAt)
    {
        $this->eventStartAt = $eventStartAt;

        return $this;
    }

    /**
     * Get eventStartAt
     *
     * @return \DateTime 
     */
    public function getEventStartAt()
    {
        return $this->eventStartAt;
    }

    /**
     * Set eventEndAt
     *
     * @param \DateTime $eventEndAt
     * @return Message
     */
    public function setEventEndAt($eventEndAt)
    {
        $this->eventEndAt = $eventEndAt;

        return $this;
    }

    /**
     * Get eventEndAt
     *
     * @return \DateTime 
     */
    public function getEventEndAt()
    {
        return $this->eventEndAt;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     * @return Message
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     * @return Message
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Get archived
     *
     * @return boolean 
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Message
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Message
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }



    /**
     * Set user
     *
     * @param \Eeemarv\EeemarvBundle\Entity\User $user
     * @return Message
     */
    public function setUser(\Eeemarv\EeemarvBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Eeemarv\EeemarvBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set category
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Category $category
     * @return Message
     */
    public function setCategory(\Eeemarv\EeemarvBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Eeemarv\EeemarvBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add images
     *
     * @param \Eeemarv\EeemarvBundle\Entity\MessageImage $images
     * @return Message
     */
    public function addImage(\Eeemarv\EeemarvBundle\Entity\MessageImage $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Eeemarv\EeemarvBundle\Entity\MessageImage $images
     */
    public function removeImage(\Eeemarv\EeemarvBundle\Entity\MessageImage $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }


    /**
     * Set profileUser
     *
     * @param \Eeemarv\EeemarvBundle\Entity\User $profileUser
     * @return Message
     */
    public function setProfileUser(\Eeemarv\EeemarvBundle\Entity\User $profileUser)
    {
        $this->profileUser = $profileUser;

        return $this;
    }

    /**
     * Get userProfile
     *
     * @return \Eeemarv\EeemarvBundle\Entity\User 
     */
    public function getProfileUser()
    {
        return $this->profileUser;
    }


    /**
     * Add transactions
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Transaction $transactions
     * @return Message
     */
    public function addTransaction(\Eeemarv\EeemarvBundle\Entity\Transaction $transactions)
    {
        $this->transactions[] = $transactions;

        return $this;
    }

    /**
     * Remove transactions
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Transaction $transactions
     */
    public function removeTransaction(\Eeemarv\EeemarvBundle\Entity\Transaction $transactions)
    {
        $this->transactions->removeElement($transactions);
    }

    /**
     * Get transactions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTransactions()
    {
        return $this->transactions;
    }




    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Message
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
     * @param \Eeemarv\EeemarvBundle\Entity\User $createdBy
     * @return Message
     */
    public function setCreatedBy(\Eeemarv\EeemarvBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Eeemarv\EeemarvBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Message
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
     * @param \Eeemarv\EeemarvBundle\Entity\User $updatedBy
     * @return Message
     */
    public function setUpdatedBy(\Eeemarv\EeemarvBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \Eeemarv\EeemarvBundle\Entity\User 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Message
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
        
        return $this;
    }
    
    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }


    /**
     * Set unvalidatedAt
     *
     * @param \DateTime $unvalidatedAt
     * @return Message
     */
    public function setUnvalidatedAt($unvalidatedAt)
    {
        $this->unvalidatedAt = $unvalidatedAt;
        
        return $this;
    }
    
    /**
     * Get unvalidatedAt
     *
     * @return \DateTime 
     */
    public function getUnvalidatedAt()
    {
        return $this->unvalidatedAt;
    }



    /**
     * Set subject
     *
     * @param string $subject
     * @return Message
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Message
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
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
     * Add comments
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Message $comments
     * @return Message
     */
    public function addComment(\Eeemarv\EeemarvBundle\Entity\Message $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Message $comments
     */
    public function removeComment(\Eeemarv\EeemarvBundle\Entity\Message $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set commentCount
     *
     * @param integer $commentCount
     * @return Message
     */
    public function setCommentCount($commentCount = 0)
    {
        $this->commentCount = $commentCount;
    
        return $this;
    }

    /**
     * Get commentCount
     *
     * @return integer
     */
    public function getCommentCount()
    {
        return $this->commentCount;
    }

    /**
     * Set lastCommentAt
     *
     * @param \DateTime $lastCommentAt
     * @return Message
     */
    public function setLastCommentAt($lastCommentAt)
    {
        $this->lastCommentAt = $lastCommentAt;
        
        return $this;
    }
    
    /**
     * Get lastCommentAt
     *
     * @return \DateTime 
     */
    public function getLastCommentAt()
    {
        return $this->lastCommentAt;
    }

    /**
     * Set isCommentable
     *
     * @param boolean $isCommentable
     * @return Message
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
     * Set isOffer
     *
     * @param boolean $isOffer
     * @return Message
     */
    public function setIsOffer($isOffer)
    {
        $this->isOffer = $isOffer;
    
        return $this;
    }

    /**
     * Get isOffer
     *
     * @return boolean 
     */
    public function getIsOffer()
    {
        return $this->isOffer;
    }

    /**
     * Set isWant
     *
     * @param boolean $isWant
     * @return Message
     */
    public function setIsWant($isWant)
    {
        $this->isWant = $isWant;
    
        return $this;
    }

    /**
     * Get isWant
     *
     * @return boolean 
     */
    public function getIsWant()
    {
        return $this->isWant;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Message
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    
        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
    
    /**
     * Set valid
     *
     * @param boolean $valid
     * @return Message
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    
        return $this;
    }

    /**
     * Get valid
     *
     * @return boolean 
     */
    public function getValid()
    {
        return $this->valid;
    }    
    
}
