<?php

namespace App\Document;

//use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
//use Symfony\Component\Security\Core\User\UserInterface;
//use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Component\Security\Core\User\AdvancedUserInterface;

use Doctrine\Bundle\MongoDBBundle\Validator\Constraints\Unique as MongoDBUnique;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

///**
// * @MongoDB\Document(repositoryClass="App\Repository\UserRepository")
// * @UniqueEntity("username")
// * @UniqueEntity("email")
// */
/**
 * @MongoDB\Document(collection="users")
 * @MongoDBUnique(fields="email")
 */
class User
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;

    /**
     * @MongoDB\Field(type="string")
     * @Assert\NotBlank()
     */
    protected $password;

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // stupid simple encryption (please don't copy it!)
    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
//    const ROLE_DEFAULT = 'BROKER';
//
//    const ROLE_LEGAL = 'LEGAL';
//
//    /**
//     * @MongoDB\Id(strategy="auto")
//     */
//    protected $id;
//
//    /**
//     * @MongoDB\Field(type="string")
//     * @Assert\NotBlank()
//     */
//    protected $username;
//
//    /**
//     * @MongoDB\Field(type="string")
//     * @Assert\NotBlank()
//     */
//    protected $email;
//
//    /**
//     * @MongoDB\Field(type="boolean")
//     */
//    protected $enabled;
//
//    /**
//     * @MongoDB\Field(type="string")
//     */
//    protected $password;
//
//    /**
//     * @MongoDB\Field(type="collection")
//     */
//    protected $roles;
//
//    /**
//     * User constructor.
//     */
//    public function __construct()
//    {
//        $this->enabled = false;
//        $this->roles = array();
//    }
//
//    /**
//     * Get id
//     *
//     * @return id $id
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * Get username
//     *
//     * @return string $username
//     */
//    public function getUsername()
//    {
//        return $this->username;
//    }
//
//    /**
//     * Get password
//     *
//     * @return string $password
//     */
//    public function getPassword()
//    {
//        return $this->password;
//    }
//
//    /**
//     * Get enabled
//     *
//     * @return boolean $enabled
//     */
//    public function isEnabled()
//    {
//        return $this->enabled;
//    }
//
//    /**
//     * Get roles
//     *
//     * @return array $roles
//     */
//    public function getRoles()
//    {
//        $roles = $this->roles;
//
//        // we need to make sure to have at least one role
//        $roles[] = static::ROLE_DEFAULT;
//
//        return array_unique($roles);
//    }
//
//    public function hasRole($role)
//    {
//        return in_array(strtoupper($role), $this->getRoles(), true);
//    }
//
//
//    public function removeRole($role)
//    {
//        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
//            unset($this->roles[$key]);
//            $this->roles = array_values($this->roles);
//        }
//
//        return $this;
//    }
//
//    /**
//     * Set username
//     *
//     * @param string $username
//     * @return $this
//     */
//    public function setUsername($username)
//    {
//        $this->username = $username;
//
//        return $this;
//    }
//
//    /**
//     * Set email
//     *
//     * @param string $email
//     * @return $this
//     */
//    public function setEmail($email)
//    {
//        $this->email = $email;
//
//        return $this;
//    }
//
//    /**
//     * Set password
//     *
//     * @param string $password
//     * @return $this
//     */
//    public function setPassword($password)
//    {
//        $this->password = $password;
//
//        return $this;
//    }
//
//    /**
//     * Set enabled
//     *
//     * @param boolean $enabled
//     * @return $this
//     */
//    public function setEnabled($enabled)
//    {
//        $this->enabled = (bool) $enabled;
//
//        return $this;
//    }
//
//    /**
//     * Set roles
//     *
//     * @param array $roles
//     * @return $this
//     */
//    public function setRoles(array $roles)
//    {
//        $this->roles = array();
//
//        foreach ($roles as $role) {
//            $this->addRole($role);
//        }
//
//        return $this;
//    }
//
//    public function getSalt()
//    {
//        return '';
//    }
//
//    public function eraseCredentials()
//    {
//        // TODO: Implement eraseCredentials() method.
//    }
//
//    public function isAccountNonExpired()
//    {
//        return true;
//    }
//
//    public function isAccountNonLocked()
//    {
//        return true;
//    }
//
//    public function isCredentialsNonExpired()
//    {
//        return true;
//    }
//
//
//    public function isLegal()
//    {
//        return $this->hasRole('ROLE_LEGAL');
//    }
//
//    public function setLegalRole($boolean)
//    {
//        if (true === $boolean) {
//            $this->addRole('ROLE_LEGAL');
//        } else {
//            $this->removeRole('ROLE_LEGAL');
//        }
//
//        return $this;
//    }
//
////    public function serialize()
////    {
////        return serialize(array(
////            $this->password,
////            $this->username,
////            $this->enabled,
////            $this->id,
////            $this->email,
////        ));
////    }
////
////    public function unserialize($serialized)
////    {
////        $data = unserialize($serialized);
////
////        list(
////            $this->password,
////            $this->username,
////            $this->id,
////            $this->email,
////            ) = $data;
////    }
//
//    /**
//     * @return string
//     */
//    public function __toString()
//    {
//        return (string) $this->getUsername();
//    }

}