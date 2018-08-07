<?php


namespace App\GithubAuth\Communication\Controller;


use DataProvider\GithubAccessTokenRequestDataProvider;
use DataProvider\GithubAuthRequestDataProvider;
use DataProvider\GithubRequestDataProvider;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Xervice\Api\Business\Controller\AbstractApiController;

/**
 * @method \Xervice\GithubAuth\GithubAuthFacade getFacade()
 * @method \App\GithubAuth\GithubAuthFactory getFactory()
 * @method \Xervice\GithubAuth\GithubAuthClient getClient()
 */
class GithubController extends AbstractApiController
{
    public function indexAction(): void
    {
        $auth = new GithubAuthRequestDataProvider();
        $auth
            ->setRedirectUrl($this->getFactory()->getRedirectBaseUrl() . '/github/auth')
            ->setScope('read:user,user:email');

        $this->getFacade()->authForGithub($auth);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \App\User\Business\Exception\AuthentificationException
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function authAction(Request $request)
    {
        $token = new GithubAccessTokenRequestDataProvider();
        $token
            ->setCode($request->query->get('code'))
            ->setRedirectUrl($this->getFactory()->getRedirectBaseUrl() . '/github/oauth');

        $token = $this->getFacade()->getAccessToken($token);
        $newUser = $this->getFactory()->createGithubUserWriter()->addUserFromGithub($token->getAccessToken());
        $this->getFactory()->getUserFacade()->loginUserWithoutAuthentification($newUser);

        return new RedirectResponse('/');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function oauthAction(Request $request): Response
    {
        return $this->sendResponse('');
    }
}