<?php


namespace App\GithubAuth\Communication\Controller;


use DataProvider\GithubAccessTokenRequestDataProvider;
use DataProvider\GithubAuthRequestDataProvider;
use DataProvider\GithubRequestDataProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            ->setScope('read:user,user:email');

        $this->getFacade()->authForGithub($auth);
    }

    public function authAction(Request $request)
    {
        $token = new GithubAccessTokenRequestDataProvider();
        $token
            ->setCode($request->query->get('code'))
            ->setRedirectUrl('https://dockerci.mibexx.de/github/oauth');

        $token = $this->getFacade()->getAccessToken($token);

        $request = new GithubRequestDataProvider();
        $request
            ->setAccessToken($token->getAccessToken())
            ->setApiUrl('https://api.github.com/user');

        $user = $this->getClient()->getFromGithub($request);

        $request = new GithubRequestDataProvider();
        $request
            ->setAccessToken($token->getAccessToken())
            ->setApiUrl('https://api.github.com/user/emails');

        $email = $this->getClient()->getFromGithub($request);
        dump($email);

        return $this->sendResponse('');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function oauthAction(Request $request): Response
    {
        return $this->sendResponse($request->getContent());
    }
}