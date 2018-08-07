<?php


namespace App\User\Communication\Controller;


use App\Application\Communication\Controller\AbstractTwigController;
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
 * @method \App\User\UserFacade getFacade()
 */
class UserController extends AbstractTwigController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \App\User\Business\Exception\AuthentificationException
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    public function loginAction(Request $request): Response
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        $this->getFacade()->loginUser($username, $password);

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

    public function registerAction(): Response
    {
        $user = new UserDataProvider();

        $formFactory = Forms::createFormFactoryBuilder()
            ->getFormFactory();
        $form = $formFactory->createBuilder(FormType::class, $user)->getForm();

        dump($form);

        return $this->sendTwig('pages/register.twig', [
            'form' => $form
        ]);
    }
}