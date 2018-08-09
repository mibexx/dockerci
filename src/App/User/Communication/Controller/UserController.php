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
 * @method \Xervice\User\UserFacade getFacade()
 * @method \Xervice\User\UserFactory getFactory()
 */
class UserController extends AbstractTwigController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \InvalidArgumentException
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Xervice\User\Business\Exception\UserException
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
        }
        catch (UserException $exception) {
            $suffix = '?error=1';
        }

        return new RedirectResponse('/' . $suffix);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \InvalidArgumentException
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
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
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Xervice\User\Business\Exception\UserException
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
    private
    function getUserLoginFromData(
        $userData
    ): \DataProvider\UserLoginDataProvider {
        $credentials = new UserCredentialDataProvider();
        $credentials
            ->setHash(password_hash($userData['password'], PASSWORD_BCRYPT));

        $login = new UserLoginDataProvider();
        $login
            ->setUserCredential($credentials);
        return $login;
    }

    /**
     * @param $user
     * @param $userData
     *
     * @return \DataProvider\UserDataProvider
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Xervice\User\Business\Exception\UserException
     */
    private function createOrUpdateUser($user, $userData): UserDataProvider
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