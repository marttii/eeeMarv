<?php

namespace Eeemarv\EeemarvBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Eeemarv\EeemarvBundle\Validator\Constraints as EeemarvAssert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

//@
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\GeographicalBundle\Annotation as Vich;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Eeemarv\EeemarvBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Geographical(on="update") 
 */
class User extends BaseUser
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


/** fos user fields **/

    /**
     * var string
     * 
     * ORM\Column(type="string")
     */
//    protected $username;

    /**
     * var string
     * 
     * ORM\Column(type="string", name="username_canonical", unique=true)
     */
//    protected $usernameCanonical;

    /*
     * var string
     * 
     * ORM\Column(type="string")
     */
//    protected $email;

    /**
     * var string
     * 
     * ORM\Column(type="string", name="email_canonical", unique=true) 
     */
//    protected $emailCanonical;

    /**
     * @var boolean
     * 
     * ORM\Column(type="boolean")
     */
//    protected $enabled;

    /**
     * The salt to use for hashing
     *
     * @var string
     * 
     * ORM\Column(type="string")
     */
//    protected $salt;

    /**
     * Encrypted password. Must be persisted.
     *
     * var string
     * 
     * ORM\Column(type="string")
     */
//    protected $password;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * var string
     * 
     * @Assert\Length(min=6)
     */
    protected $plainPassword;
    

    /**
     * var \DateTime
     * 
     * ORM\Column(type="datetime", name="last_login", nullable=true)
     */
//    protected $lastLogin;

    /**
     * Random string sent to the user email address in order to verify it
     *
     * var string
     * 
     * ORM\Column(type="string", name="confirmation_token", nullable=true)
     */
//    protected $confirmationToken;

    /**
     * var \DateTime
     * 
     * ORM\Column(type="datetime", name="password_requested_at", nullable=true)
     */
//    protected $passwordRequestedAt;

    /**
     * var Collection
     */
//    protected $groups;

    /**
     * var boolean
     * 
     * ORM\Column(type="boolean")
     */
//    protected $locked;

    /**
     * var boolean
     * 
     * ORM\Column(type="boolean")
     */
//    protected $expired;

    /**
     * var \DateTime
     * 
     * ORM\Column(type="datetime", name="expires_at", nullable=true)
     */
//    protected $expiresAt;

    /**
     * var array
     * 
     * ORM\Column(type="array")
     */
//    protected $roles;

    /**
     * var boolean
     * 
     * ORM\Column(type="boolean", name="credentials_expired") 
     */
//    protected $credentialsExpired;

    /**
     * var \DateTime
     * 
     * ORM\Column(type="datetime", name="credentials_expire_at", nullable=true) 
     */
//    protected $credentialsExpireAt;


/** **/




	/**
	 * @ORM\Column(type="string", name="first_name", nullable=true)
	 * @Assert\NotBlank(groups={"Registration", "Profile"})
	 */
	protected $firstName = null;

	
	/**
	 * @ORM\Column(type="string", name="last_name", nullable=true)
	 * @Assert\NotBlank(groups={"Registration", "Profile"})
	 */
	protected $lastName = null;


	/**
	 * @ORM\Column(type="string", length=1, nullable=true)
	 * @Assert\NotBlank(groups={"Registration", "Profile"})
	 */
	protected $gender = null; 


	/**
	 * @ORM\Column(type="date")
	 * @Assert\Date
	 * @Assert\NotBlank(groups={"Registration", "Profile"})
	 */
	protected $birthday = null;



	/**
	 * @ORM\Column(type="string", name="street")
	 * @Assert\NotBlank(groups={"Registration", "Profile"})
	 */
	protected $street = null;
	
	/**
	 * @ORM\Column(type="string", length=8, name="house_number")
	 * @Assert\NotBlank(groups={"Registration", "Profile"})
	 */
	protected $houseNumber = null;
	
	/**
	 * @ORM\Column(type="string", length=8, nullable=true)
	 */
	protected $box = null;	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Place", inversedBy="users")
	 * @ORM\JoinColumn(name="place_id")
	 * @Assert\NotBlank(groups={"Registration", "Profile"})
	 */
	protected $place = null;	


	/**
	* @ORM\Column(type="decimal", precision=9, scale=6, nullable=true)
	 */
	protected $latitude = null;	
	
	/**
	* @ORM\Column(type="decimal", precision=9, scale=6, nullable=true)
	 */
	protected $longitude = null;

	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	protected $phone = null;	
	
	/**
	 * @ORM\Column(type="string", length=50, nullable=true)
	 */
	protected $mobile = null;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 * @Assert\Url
	 */
	protected $website = null;	

	/**
	 * @ORM\OneToOne(targetEntity="Message", inversedBy="profileUser")
	 * @ORM\JoinColumn(name="profile_message_id", nullable=true)
	 */
	protected $profileMessage;




 	/**
	 * @ORM\Column(type="string", length=8, unique=true, nullable=true)
	 * --EeemarvAssert\UserCode
	 */
	protected $code = null;
	

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $balance = 0;
	
	/**
	 * @ORM\Column(type="integer", name="balance_limit")
	 */
	protected $balanceLimit = 90000;	

	/**
	 * @ORM\Column(type="boolean", name="is_active")
	 */
	protected $isActive = false;
	
	/**
	 * @ORM\Column(type="boolean", name="is_leaving")
	 */
	protected $isLeaving = false;	
	

	/**
	 * There have to be exact 2 system accounts,  
	 * one inactive, which is nulling the inactive users
	 * and one active, which is the secretariat.
	 * Both system accounts have NO ROLES and cannot be used for sessions. 
	 * 
	 * @ORM\Column(type="boolean", name="is_system_account")
	 * 
	 */
	protected $isSystemAccount = false;
	
	/**
	 * @ORM\Column(type="boolean", name="is_external")
	 */
	protected $isExternal = false;		
	
	
	/**
	 * @ORM\Column(name="external_password", nullable=true)
	 */
	protected $externalPassword = null;


 	/**
 	 * @ORM\ManyToOne(targetEntity="User", inversedBy="children")
	 * @ORM\JoinColumn(name="parent_id", nullable=true)
	 * only external users have a parent (lets-group)
	 */
	protected $parent = null;	

    /**
     * @var array $children
     * @ORM\OneToMany(targetEntity="User", mappedBy="parent")
     */
    private $children; 
	
		
    /**
     * @var array $transactionsTo
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="toUser")
     */
    private $transactionsTo;    

    /**
     * @var array $transactionsFrom
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="fromUser")
     */
    private $transactionsFrom;    

    /**
     * @var array $messages
     * @ORM\OneToMany(targetEntity="Message", mappedBy="user")
     */
    private $messages;
    
    /**
     * @var array $comments
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="createdBy")
     */
    private $comments;    

    /**
     * @var array $nonces
     * @ORM\OneToMany(targetEntity="UserNonce", mappedBy="user")
     */
    private $nonces;  

 
  	/**
	 * @ORM\Column(type="string", length=8, nullable=true)
	 */
	protected $locale = null;	


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

	/**
	 * @Gedmo\Timestampable(on="change", field="isActive", value=true)
	 * @ORM\Column(type="datetime", name="activated_at", nullable=true)
	 */
	protected $activatedAt = null;	
	
	/**
	 * @Gedmo\Blameable(on="change", field="isActive", value=true)
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="activated_by", nullable=true)
	 */
	protected $activatedBy = null;	
	
	/**
	 * @Gedmo\Timestampable(on="change", field="isLeaving", value=true)
	 * @ORM\Column(type="datetime", name="is_leaving_since", nullable=true)
	 */
	protected $isLeavingSince = null;	
	
	/**
	 * @Gedmo\Blameable(on="change", field="isLeaving", value=true)
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="is_leaving_set_by", nullable=true)
	 */
	protected $isLeavingSetBy = null;			



	public function __construct()
    {
        parent::__construct(); 
        $this->transactionsTo = new ArrayCollection();        
        $this->transactionsFrom = new ArrayCollection();      
        $this->messages = new ArrayCollection();
        $this->comments = new ArrayCollection();       
        $this->nonces = new ArrayCollection();                                 
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
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }


    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    
        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return User
     */
    public function setStreet($street)
    {
        $this->street = $street;
    
        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set houseNumber
     *
     * @param string $houseNumber
     * @return User
     */
    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;
    
        return $this;
    }

    /**
     * Get houseNumber
     *
     * @return string 
     */
    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    /**
     * Set box
     *
     * @param string $box
     * @return User
     */
    public function setBox($box)
    {
        $this->box = $box;
    
        return $this;
    }

    /**
     * Get box
     *
     * @return string 
     */
    public function getBox()
    {
        return $this->box;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return User
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return User
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    
        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return User
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    
        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return User
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set balance
     *
     * @param integer $balance
     * @return User
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    
        return $this;
    }

    /**
     * Get balance
     *
     * @return integer 
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set balanceLimit
     *
     * @param integer $balanceLimit
     * @return User
     */
    public function setBalanceLimit($balanceLimit)
    {
        $this->balanceLimit = $balanceLimit;
    
        return $this;
    }

    /**
     * Get balanceLimit
     *
     * @return integer 
     */
    public function getBalanceLimit()
    {
        return $this->balanceLimit;
    }

    /**
     * Set isSystemAccount
     *
     * @param boolean $isSystemAccount
     * @return User
     */
    public function setIsSystemAccount($isSystemAccount)
    {
        $this->isSystemAccount = $isSystemAccount;
    
        return $this;
    }

    /**
     * Get isSystemAccount
     *
     * @return boolean 
     */
    public function getIsSystemAccount()
    {
        return $this->isSystemAccount;
    }




    /**
     * Set locale
     *
     * @param string $locale
     * @return User
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    
        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }



    /**
     * Set place
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Place $place
     * @return User
     */
    public function setPlace(\Eeemarv\EeemarvBundle\Entity\Place $place = null)
    {
        $this->place = $place;
    
        return $this;
    }

    /**
     * Get place
     *
     * @return \Eeemarv\EeemarvBundle\Entity\Place 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Add transactionsTo
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Transaction $transactionsTo
     * @return User
     */
    public function addTransactionsTo(\Eeemarv\EeemarvBundle\Entity\Transaction $transactionTo)
    {
        $this->transactionsTo[] = $transactionTo;
    
        return $this;
    }

    /**
     * Remove transactionsTo
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Transaction $transactionTo
     */
    public function removeTransactionsTo(\Eeemarv\EeemarvBundle\Entity\Transaction $transactionTo)
    {
        $this->transactionsTo->removeElement($transactionTo);
    }

    /**
     * Get transactionsTo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTransactionsTo()
    {
        return $this->transactionsTo;
    }

    /**
     * Add transactionsFrom
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Transaction $transactionFrom
     * @return User
     */
    public function addTransactionsFrom(\Eeemarv\EeemarvBundle\Entity\Transaction $transactionFrom)
    {
        $this->transactionsFrom[] = $transactionFrom;
    
        return $this;
    }

    /**
     * Remove transactionsFrom
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Transaction $transactionFrom
     */
    public function removeTransactionsFrom(\Eeemarv\EeemarvBundle\Entity\Transaction $transactionFrom)
    {
        $this->transactionsFrom->removeElement($transactionFrom);
    }

    /**
     * Get transactionsFrom
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTransactionsFrom()
    {
        return $this->transactionsFrom;
    }


    /**
     * Add messages
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Message $message
     * @return User
     */
    public function addMessages(\Eeemarv\EeemarvBundle\Entity\Message $message)
    {
        $this->messages[] = $message;
    
        return $this;
    }

    /**
     * Remove messages
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Message $message
     */
    public function removeMessages(\Eeemarv\EeemarvBundle\Entity\Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessages()
    {
        return $this->messages;
    }


    /**
     * Add comments
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Comment $comment
     * @return User
     */
    public function addComments(\Eeemarv\EeemarvBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Comment $comment
     */
    public function removeComments(\Eeemarv\EeemarvBundle\Entity\Comment $comment)
    {
        $this->messages->removeElement($comment);
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
     * Add nonce
     *
     * @param \Eeemarv\EeemarvBundle\Entity\UserNonce $nonce
     * @return User
     */
    public function addNonces(\Eeemarv\EeemarvBundle\Entity\UserNonce $nonce)
    {
        $this->nonces[] = $nonce;
    
        return $this;
    }

    /**
     * Remove nonce
     *
     * @param \Eeemarv\EeemarvBundle\Entity\UserNonce $nonce
     */
    public function removeNonces(\Eeemarv\EeemarvBundle\Entity\UserNonce $nonce)
    {
        $this->nonces->removeElement($nonce);
    }

    /**
     * Get nonces
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNonces()
    {
        return $this->nonces;
    }




    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * Set activatedAt
     *
     * @param \DateTime $activatedAt
     * @return User
     */
    public function setActivatedAt($activatedAt)
    {
        $this->activatedAt = $activatedAt;

        return $this;
    }

    /**
     * Get activatedAt
     *
     * @return \DateTime 
     */
    public function getActivatedAt()
    {
        return $this->activatedAt;
    }


    /**
     * Set activatedBy
     *
     * @param \Eeemarv\EeemarvBundle\Entity\User $activatedBy
     * @return User
     */
    public function setActivatedBy(\Eeemarv\EeemarvBundle\Entity\User $activatedBy = null)
    {
        $this->activatedBy = $activatedBy;

        return $this;
    }

    /**
     * Get activatedBy
     *
     * @return \Eeemarv\EeemarvBundle\Entity\User 
     */
    public function getActivatedBy()
    {
        return $this->activatedBy;
    }

 
    
      /**
     * @Vich\GeographicalQuery
     * This method builds the full address to query for coordinates.
     */ 
    public function getAddress()
    {
		if (!$this->place){
			return null;
		}	
		
        return sprintf('%s, %s, %s %s',
            $this->street . ' ' . $this->houseNumber,
            $this->place->getName(),
            $this->place->getCountry(),
            $this->place->getPostalCode());
    }   

    public function __toString()
    {
        return $this->getCode . $this->username;
    }      
    

    /**
     * Set profileMessage
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Message $profileMessage
     * @return User
     */
    public function setProfileMessage(\Eeemarv\EeemarvBundle\Entity\Message $profileMessage = null)
    {
        $this->profileMessage = $profileMessage;
    
        return $this;
    }

    /**
     * Get profileMessage
     *
     * @return \Eeemarv\EeemarvBundle\Entity\Message 
     */
    public function getProfileMessage()
    {
        return $this->profileMessage;
    }

    /**
     * Set parent
     *
     * @param \Eeemarv\EeemarvBundle\Entity\User $parent
     * @return User
     */
    public function setParent(\Eeemarv\EeemarvBundle\Entity\User $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Eeemarv\EeemarvBundle\Entity\User 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \Eeemarv\EeemarvBundle\Entity\User $children
     * @return User
     */
    public function addChildren(\Eeemarv\EeemarvBundle\Entity\User $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Eeemarv\EeemarvBundle\Entity\User $children
     */
    public function removeChildren(\Eeemarv\EeemarvBundle\Entity\User $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add messages
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Message $messages
     * @return User
     */
    public function addMessage(\Eeemarv\EeemarvBundle\Entity\Message $messages)
    {
        $this->messages[] = $messages;
    
        return $this;
    }

    /**
     * Remove messages
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Message $messages
     */
    public function removeMessage(\Eeemarv\EeemarvBundle\Entity\Message $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Add nonces
     *
     * @param \Eeemarv\EeemarvBundle\Entity\UserNonce $nonces
     * @return User
     */
    public function addNonce(\Eeemarv\EeemarvBundle\Entity\UserNonce $nonces)
    {
        $this->nonces[] = $nonces;
    
        return $this;
    }

    /**
     * Remove nonces
     *
     * @param \Eeemarv\EeemarvBundle\Entity\UserNonce $nonces
     */
    public function removeNonce(\Eeemarv\EeemarvBundle\Entity\UserNonce $nonces)
    {
        $this->nonces->removeElement($nonces);
    }

    /**
     * Set isSystem
     *
     * @param boolean $isSystem
     * @return User
     */
    public function setIsSystem($isSystem)
    {
        $this->isSystem = $isSystem;
    
        return $this;
    }

    /**
     * Get isSystem
     *
     * @return boolean 
     */
    public function getIsSystem()
    {
        return $this->isSystem;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isLeaving
     *
     * @param boolean $isLeaving
     * @return User
     */
    public function setIsLeaving($isLeaving)
    {
        $this->isLeaving = $isLeaving;
    
        return $this;
    }

    /**
     * Get isLeaving
     *
     * @return boolean 
     */
    public function getIsLeaving()
    {
        return $this->isLeaving;
    }

    /**
     * Set isLeavingSince
     *
     * @param \DateTime $isLeavingSince
     * @return User
     */
    public function setIsLeavingSince($isLeavingSince)
    {
        $this->isLeavingSince = $isLeavingSince;
    
        return $this;
    }

    /**
     * Get isLeavingSince
     *
     * @return \DateTime 
     */
    public function getIsLeavingSince()
    {
        return $this->isLeavingSince;
    }

    /**
     * Set isLeavingSetBy
     *
     * @param \Eeemarv\EeemarvBundle\Entity\User $isLeavingSetBy
     * @return User
     */
    public function setIsLeavingSetBy(\Eeemarv\EeemarvBundle\Entity\User $isLeavingSetBy = null)
    {
        $this->isLeavingSetBy = $isLeavingSetBy;
    
        return $this;
    }

    /**
     * Get isLeavingSetBy
     *
     * @return \Eeemarv\EeemarvBundle\Entity\User 
     */
    public function getIsLeavingSetBy()
    {
        return $this->isLeavingSetBy;
    }

    /**
     * Set externalPassword
     *
     * @param string $externalPassword
     * @return User
     */
    public function setExternalPassword($externalPassword)
    {
        $this->externalPassword = $externalPassword;
    
        return $this;
    }

    /**
     * Get externalPassword
     *
     * @return string 
     */
    public function getExternalPassword()
    {
        return $this->externalPassword;
    }

    /**
     * Set isExternal
     *
     * @param boolean $isExternal
     * @return User
     */
    public function setIsExternal($isExternal)
    {
        $this->isExternal = $isExternal;
    
        return $this;
    }

    /**
     * Get isExternal
     *
     * @return boolean 
     */
    public function getIsExternal()
    {
        return $this->isExternal;
    }
}
