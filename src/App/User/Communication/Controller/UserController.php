<?php


namespace App\User\Communication\Controller;


use App\Application\Communication\Controller\AbstractTwigController;
use DataProvider\UserAuthDataProvider;
use DataProvider\UserCredentialDataProvider;
use DataProvider\UserDataProvider;
use DataProvider\UserLoginDataProvider;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Xervice\User\Business\Exception\UserException;

/**
 * @method \Xervice\User\Business\UserFacade getFacade()
 */
class UserController extends AbstractTwigController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request): Response
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        $auth = new UserAuthDataProvider();
        $auth
            ->setUser(
                (new UserDataProvider())->setEmail($username)
            )
            ->setCredential(
                (new UserCredentialDataProvider())->setHash($password)
            )
            ->setType('Default')
        ;

        $suffix = '';
        try {
            $this->getFacade()->login($auth);
        } catch (UserException $exception) {
            $suffix = '?error=1';
        }

        return new RedirectResponse('/' . $suffix);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \InvalidArgumentException
     */
    public function logoutAction(): Response
    {
        $this->getFacade()->logout();
        return new RedirectResponse('/');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Xervice\Core\Business\Exception\ServiceNotFoundException
     */
    public function registerAction(Request $request): Response
    {
        $user = new UserDataProvider();
        $state = '0';
        if ($request->request->has('registerForm')) {
            $state = -1;
            $userData = $request->request->get('registerForm');

            $user->fromArray($userData);

            $user = $this->getFacade()->getUserFromEmail($user->getEmail());

            try {
                $user = $this->createOrUpdateUser($user, $userData);
                $state = 1;
            } catch (UserException $exception) {
            }
        }

        return $this->sendTwig(
            'pages/register.twig',
            [
                'registerForm' => $user->toArray(),
                'state'        => $state
            ]
        );
    }

    /**
     * @param $userData
     *
     * @return \DataProvider\UserLoginDataProvider
     */
    private function getUserLoginFromData(
        array $userData
    ): \DataProvider\UserLoginDataProvider {
        $credentials = new UserCredentialDataProvider();
        $credentials
            ->setHash(password_hash($userData['Password'], PASSWORD_BCRYPT));

        $login = new UserLoginDataProvider();
        $login
            ->setUserCredential($credentials);
        return $login;
    }

    /**
     * @param \DataProvider\UserDataProvider $user
     * @param array $userData
     *
     * @return \DataProvider\UserDataProvider
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Xervice\User\Business\Exception\UserException
     */
    private function createOrUpdateUser(UserDataProvider $user, array $userData): UserDataProvider
    {
        if ($user->hasUserId()) {
            $login = $this->getFacade()->getLoginFromUserByType($user->getUserId(), 'Default');
            if (!$login->hasUserLoginId()) {
                $login = $this->getUserLoginFromData($userData);
                $user->addUserLogin($login);
                $this->getFacade()->updateUser($user);
            } else {
                throw new UserException('User already exist');
            }
        } else {
            $login = $this->getUserLoginFromData($userData);
            $user->addUserLogin($login);
            $user = $this->getFacade()->createUser($user);
        }

        return $user;
}
}