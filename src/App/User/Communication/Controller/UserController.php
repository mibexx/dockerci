<?php


namespace App\User\Communication\Controller;


use App\Application\Communication\Controller\AbstractTwigController;
use DataProvider\UserAuthDataProvider;
use DataProvider\UserCredentialDataProvider;
use DataProvider\UserDataProvider;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Xervice\Controller\Business\Controller\AbstractController;

/**
 * @method \Xervice\User\UserFacade getFacade()
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
            ->setType('Default');

        $this->getFacade()->login($auth);

        return new RedirectResponse('/');
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
     */
    public function registerAction(Request $request): Response
    {
        $user = new UserDataProvider();
        if ($request->request->has('registerForm')) {
            $user->fromArray($request->request->get('registerForm'));

            $user = $this->getFacade()->registerUser($user);
            if ($user->hasUserId()) {
                $this->getFacade()->loginUserWithoutAuthentification($user);
                return new RedirectResponse('/');
            }
        }

        return $this->sendTwig('pages/register.twig', [
            'registerForm' => $user->toArray()
        ]);
    }
}