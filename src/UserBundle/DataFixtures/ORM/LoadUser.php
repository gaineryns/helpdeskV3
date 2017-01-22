<?php
/**
 * Created by PhpStorm.
 * User: gaineryns
 * Date: 22/01/17
 * Time: 11:21
 */

namespace UserBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

class LoadUser implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // les noms d'utilisateurs ä créer
        $listName = array('user', 'steve', 'admin');
        foreach ($listName as $name){
            $user = new User();
            $user-> setUsername($name);
            $user->setPassword($name);

            $user->setSalt('');
            $user->setEmail($name . '@' . $name .'.com');
            if($name == 'admin'){
                $user->setRoles(['ROLE_ADMIN']);
            }else{
                $user->setRoles(['ROLE_CLIENT']);
            }

            $manager->persist($user);
        }

        $manager->flush();
    }
}