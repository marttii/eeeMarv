<?php

namespace Eeemarv\EeemarvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Eeemarv\EeemarvBundle\Validator\Constraints as EeemarvAssert;


/**
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="Eeemarv\EeemarvBundle\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", name="unique_id", unique=true) 
     */
    protected $uniqueId;    
    

	/**
	 * @ORM\Column(type="integer")
	 * @Assert\Range(min=1)
	 */
	protected $amount = null;

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="transactionsFrom")
	 * @ORM\JoinColumn(name="from_user_id", nullable=true)
	 */
	protected $fromUser = null;
	
	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="transactionsTo")
	 * @ORM\JoinColumn(name="to_user_id", nullable=true)
	 */
	protected $toUser= null;
	
	/**
	 * @ORM\Column(type="string", name="from_code", nullable=true)
	 */
	protected $fromCode = null;
	
	/**
	 * @ORM\Column(type="string", name="to_code", nullable=true)
	 * --EeemarvAssert\ActiveUserCode
	 * @Assert\NotBlank(groups={"new"});
	 */
	protected $toCode = null;	
	
	/**
	 * @ORM\Column(type="string", name="from_name", nullable=true)
	 */
	protected $fromName = null;
	
	/**
	 * @ORM\Column(type="string", name="to_name", nullable=true)
	 */
	protected $toName = null;		

	/**
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank(groups={"new"})
	 */
	protected $description;	
	
	/**
	 * @ORM\Column(type="decimal", precision=7, scale=2, nullable=true)
	 */
	protected $distance = null;
	
	
	/**
	 * @ORM\ManyToOne(targetEntity="Message", inversedBy="transactions")
	 * @ORM\JoinColumn(name="message_id", nullable=true)
	 */
	protected $message = null; 	
	
	
/* mass-transaction */ 

 	/**
	 * @ORM\OneToMany(targetEntity="Transaction", mappedBy="parent")
	 */
	protected $transactions = null;

 	/**
	 * @ORM\ManyToOne(targetEntity="Transaction", inversedBy="transactions")
	 * @ORM\JoinColumn(name="parent_id")
	 */
	protected $parent = null;

/* */

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $external = false;

 	/**
	 * @ORM\OneToOne(targetEntity="Transaction", inversedBy="annulatedBy")
	 * @ORM\JoinColumn(name="annulation_of", nullable=true)
	 */
	protected $annulationOf = null;

 	/**
	 * @ORM\OneToOne(targetEntity="Transaction", mappedBy="annulationOf")
	 * @ORM\JoinColumn(name="annulated_by", nullable=true)
	 */
	protected $annulatedBy = null;

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $confirmed = false;

	/**
	 * @Gedmo\Timestampable(on="change", field="confirmed", value=true)
	 * @ORM\Column(type="datetime", name="confirmed_at", nullable=true)
	 */
	protected $confirmedAt = null;

	/**
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime", name="transaction_at")
	 */
	protected $transactionAt = null;

/* */	

	/**
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(type="datetime", name="created_at")
	 */
	protected $createdAt = null;
	
	/**
	 * @Gedmo\Blameable(on="create")
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="created_by")
	 */
	protected $createdBy = null;

    public function __construct()
    {
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
     * Set amount
     *
     * @param integer $amount
     * @return Transaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set fromCode
     *
     * @param string $fromCode
     * @return Transaction
     */
    public function setFromCode($fromCode)
    {
        $this->fromCode = $fromCode;

        return $this;
    }

    /**
     * Get fromCode
     *
     * @return string 
     */
    public function getFromCode()
    {
        return $this->fromCode;
    }

    /**
     * Set toCode
     *
     * @param string $toCode
     * @return Transaction
     */
    public function setToCode($toCode)
    {
        $this->toCode = $toCode;

        return $this;
    }

    /**
     * Get toCode
     *
     * @return string 
     */
    public function getToCode()
    {
        return $this->toCode;
    }

    /**
     * Set fromName
     *
     * @param string $fromName
     * @return Transaction
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * Get fromName
     *
     * @return string 
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * Set toName
     *
     * @param string $toName
     * @return Transaction
     */
    public function setToName($toName)
    {
        $this->toName = $toName;

        return $this;
    }

    /**
     * Get toName
     *
     * @return string 
     */
    public function getToName()
    {
        return $this->toName;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Transaction
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * Set external
     *
     * @param boolean $external
     * @return Transaction
     */
    public function setExternal($external)
    {
        $this->external = $external;

        return $this;
    }

    /**
     * Get external
     *
     * @return boolean 
     */
    public function getExternal()
    {
        return $this->external;
    }



    /**
     * Set fromUser
     *
     * @param \Eeemarv\EeemarvBundle\Entity\User $fromUser
     * @return Transaction
     */
    public function setFromUser(\Eeemarv\EeemarvBundle\Entity\User $fromUser = null)
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * Get fromUser
     *
     * @return \Eeemarv\EeemarvBundle\Entity\User 
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * Set toUser
     *
     * @param \Eeemarv\EeemarvBundle\Entity\User $toUser
     * @return Transaction
     */
    public function setToUser(\Eeemarv\EeemarvBundle\Entity\User $toUser = null)
    {
        $this->toUser = $toUser;

        return $this;
    }

    /**
     * Get toUser
     *
     * @return \Eeemarv\EeemarvBundle\Entity\User 
     */
    public function getToUser()
    {
        return $this->toUser;
    }



    /**
     * Add transactions
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Transaction $transactions
     * @return Transaction
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
     * Set parent
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Transaction $parent
     * @return Transaction
     */
    public function setParentTransaction(\Eeemarv\EeemarvBundle\Entity\Transaction $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Eeemarv\EeemarvBundle\Entity\Transaction 
     */
    public function getParentTransaction()
    {
        return $this->parent;
    }




    /**
     * Set distance
     *
     * @param integer $distance
     * @return Transaction
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    
        return $this;
    }

    /**
     * Get distance
     *
     * @return integer 
     */
    public function getDistance()
    {
        return $this->distance;
    }


    /**
     * Set message
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Message $message
     * @return Transaction
     */
    public function setMessage(\Eeemarv\EeemarvBundle\Entity\Message $message = null)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return \Eeemarv\EeemarvBundle\Entity\Message 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set transactionAt
     *
     * @param \DateTime $transactionAt
     * @return Transaction
     */
    public function setTransactionAt($transactionAt)
    {
        $this->transactionAt = $transactionAt;

        return $this;
    }

    /**
     * Get transactionAt
     *
     * @return \DateTime 
     */
    public function getTransactionAt()
    {
        return $this->transactionAt;
    }


    /**
     * Set confirmedAt
     *
     * @param \DateTime $confirmedAt
     * @return Transaction
     */
    public function setConfirmedAt($confirmedAt)
    {
        $this->confirmedAt = $confirmedAt;

        return $this;
    }

    /**
     * Get confirmedAt
     *
     * @return \DateTime 
     */
    public function getConfirmedAt()
    {
        return $this->confirmedAt;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Transaction
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
     * @return Transaction
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

    public function __toString()
    {		
		return $this->getDescription();
    } 

    /**
     * Set confirmed
     *
     * @param boolean $confirmed
     * @return Transaction
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    
        return $this;
    }

    /**
     * Get confirmed
     *
     * @return boolean 
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Set parent
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Transaction $parent
     * @return Transaction
     */
    public function setParent(\Eeemarv\EeemarvBundle\Entity\Transaction $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Eeemarv\EeemarvBundle\Entity\Transaction 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set annulationOf
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Transaction $annulationOf
     * @return Transaction
     */
    public function setAnnulationOf(\Eeemarv\EeemarvBundle\Entity\Transaction $annulationOf = null)
    {
        $this->annulationOf = $annulationOf;
    
        return $this;
    }

    /**
     * Get annulationOf
     *
     * @return \Eeemarv\EeemarvBundle\Entity\Transaction 
     */
    public function getAnnulationOf()
    {
        return $this->annulationOf;
    }

    /**
     * Set annulatedBy
     *
     * @param \Eeemarv\EeemarvBundle\Entity\Transaction $annulatedBy
     * @return Transaction
     */
    public function setAnnulatedBy(\Eeemarv\EeemarvBundle\Entity\Transaction $annulatedBy = null)
    {
        $this->annulatedBy = $annulatedBy;
    
        return $this;
    }

    /**
     * Get annulatedBy
     *
     * @return \Eeemarv\EeemarvBundle\Entity\Transaction 
     */
    public function getAnnulatedBy()
    {
        return $this->annulatedBy;
    }
}
