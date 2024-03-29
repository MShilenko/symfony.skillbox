<?php

namespace App\Security;

use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    /** @var UserRepository $userRepository */
    private $userRepository;

    /** @var UrlGeneratorInterface $urlGeneratorInterface */
    private $urlGenerator;

    /** @var CsrfTokenManagerInterface $csrfTokenManager */
    private $csrfTokenManager;

    /** @var LoggerInterface $apiLogger */
    private $apiLogger;

    /** @var UserPasswordEncoderInterface $userPasswordEncoder */
    private $userPasswordEncoder;

    public function __construct(
        UserRepository $userRepository,
        UrlGeneratorInterface $urlGenerator,
        CsrfTokenManagerInterface $csrfTokenManager,
        UserPasswordEncoderInterface $userPasswordEncoder,
        LoggerInterface $apiLogger
    ) {
        $this->userRepository = $userRepository;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->apiLogger = $apiLogger;
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate('app_login');
    }

    public function supports(Request $request)
    {
        return $request->attributes->get('_route') === 'app_login' && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token')
        ];

        $request->getSession()->set(Security::LAST_USERNAME, $credentials['email']);

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $csrfToken = new CsrfToken('authenticate', $credentials['csrf_token']);

        if (!$this->csrfTokenManager->isTokenValid($csrfToken)) {
            throw new InvalidCsrfTokenException();
        }

        $user = $this->userRepository->findOneBy(['email' => $credentials['email']]);

        if ($user && !$user->getIsActive()) {
            throw new CustomUserMessageAuthenticationException('Уходи бабайка!');
        }

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return  $this->userPasswordEncoder->isPasswordValid($user, $credentials['password']);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        $path = $this->getTargetPath($request->getSession(), $providerKey) ?? $this->urlGenerator->generate('app_homepage');

        $this->apiLogger->info(
            'User API',
            [
                'Name' => $token->getUsername(),
                'Route' => $request->attributes->get('_route'),
                'Url' => $path
            ]
        );

        return new RedirectResponse($path);
    }
}
