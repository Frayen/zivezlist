<?php

namespace App\security;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider as provider;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GoogleProvider extends provider
{
    private $em;
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, $em) {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response):User {
        $repo = $this->em->getRepository('App:User');
        $user = $repo->findOneBy(['username' => $response->getEmail()]);

        if ($user === null) {
            $user = new User();

            $user->setUsername($response->getEmail());
            $user->setEmail($response->getEmail());
            $user->setEnabled(true);
            $user->setProfilePicture($response->getProfilePicture());
            $user->setRoles(['ROLE_USER']);

//            $email = $response->getEmail();
//            $password = $email . time();
            $user->setPassword($this->passwordEncoder->encodePassword($user, $response->getEmail() . time() ));

            $this->em->persist($user);
            $this->em->flush();
            return $user;
        }

        return $user;
    }

    private function genratePasword() {
        $characters = array_merge(range('1', '9'), range('a', 'z'));
        $charactersLength = count($characters);
        $randomString = '';
        for ($i = 0; $i < rand(30, 255); $i++) {
            $randomString .= $characters[rand(0, $charactersLength -1)];
        }
        return $randomString;
    }
}