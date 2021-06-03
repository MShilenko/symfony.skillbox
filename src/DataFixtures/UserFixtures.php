<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
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
        // Admin
        $this->create(User::class, function (User $user) use ($manager) {
            $user
                ->setEmail('admin@symfony.skillbox')
                ->setFirstName('admin')
                ->setIsActive(true)
                ->setPassword($this->userPasswordEncoder->encodePassword($user, '123456'))
                ->setRoles(['ROLE_ADMIN']);

            $manager->persist(new ApiToken($user));
        });

         // API
         $this->create(User::class, function (User $user) use ($manager) {
            $user
                ->setEmail('api@symfony.skillbox')
                ->setFirstName('api')
                ->setIsActive(true)
                ->setPassword($this->userPasswordEncoder->encodePassword($user, '123456'))
                ->setRoles(['ROLE_API']);

            for ($i = 0; $i < 3; $i++) { 
                $manager->persist(new ApiToken($user));
            }
        });

        $this->createMany(User::class, $this->faker->numberBetween(10, 20), function (User $user) use ($manager) {
            $user
                ->setEmail($this->faker->email())
                ->setFirstName($this->faker->firstName())
                ->setIsActive(true)
                ->setPassword($this->userPasswordEncoder->encodePassword($user, '123456'));

            if ($this->faker->boolean(30)) {
                $user->setIsActive(false);
            }

            $manager->persist(new ApiToken($user));
        });
    }
}
