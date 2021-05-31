<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\UserPassportInterface;

class UserFixtures extends BaseFixtures
{
    /** @var UserPasswordEncoderInterface $userPasswordEncoder */
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class, $this->faker->numberBetween(10, 20), function (User $user) {
            $user
                ->setEmail($this->faker->email())
                ->setFirstName($this->faker->firstName())
                ->setIsActive(true)
                ->setPassword($this->userPasswordEncoder->encodePassword($user, '123456'));

            if ($this->faker->boolean(30)) {
                $user->setIsActive(false);
            }
        });
    }
}
