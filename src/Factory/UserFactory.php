<?php
/**
 * Created by PhpStorm.
 * User: sylvaincristofari
 * Date: 12/07/2018
 * Time: 10:48
 */

namespace App\Factory;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserFactory
 *
 * @package App\Factory
 */
class UserFactory
{
    /**
     * Create a User from the UserInterface.
     *
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     *
     * @return \App\Entity\User
     */
    public function create(UserInterface $user)
    {
        $u = new User();
        $u->setUsername($user->getUsername());
        $u->setEmail($user->getUsername());
        $u->setPassword($user->getPassword());

        return $u;
    }
}