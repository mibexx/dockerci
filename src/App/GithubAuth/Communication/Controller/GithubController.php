<?php


namespace App\GithubAuth\Communication\Controller;


use DataProvider\GithubAccessTokenRequestDataProvider;
use DataProvider\GithubAuthRequestDataProvider;
use DataProvider\GithubRequestDataProvider;
use Symfony\Component\HttpFoundation\Request;
use Xervice\Api\Business\Controller\AbstractApiController;

/**
 * @method \Xervice\GithubAuth\GithubAuthFacade getFacade()
 * @method \Xervice\GithubAuth\GithubAuthClient getClient()
 */
class GithubController extends AbstractApiController
{
    public function indexAction(): void
    {
        $auth = new GithubAuthRequestDataProvider();
        $auth
            ->setRedirectUrl('https://dockerci.mibexx.de/github/auth')
            ->setScope('read:user');

        $this->getFacade()->authForGithub($auth);
    }

    public function authAction(Request $request)
    {
        $token = new GithubAccessTokenRequestDataProvider();
        $token
            ->setCode($request->query->get('code'));

        $token = $this->getFacade()->getAccessToken($token);

        $request = new GithubRequestDataProvider();
        $request
            ->setAccessToken($token->getAccessToken())
            ->setApiUrl('https://api.github.com/user');

        $user = $this->getClient()->getFromGithub($request);

        dump($user);
    }
}