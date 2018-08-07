<?php


namespace App\GithubAuth\Business\User;


use App\User\UserFacade;
use DataProvider\GithubRequestDataProvider;
use DataProvider\UserDataProvider;
use Xervice\GithubAuth\Business\Api\GithubClientInterface;

class UserWriter implements UserWriterInterface
{

    /**
     * @var \App\User\UserFacade
     */
    private $userFacade;

    /**
     * @var \Xervice\GithubAuth\Business\Api\GithubClientInterface
     */
    private $githubClient;

    /**
     * UserWriter constructor.
     *
     * @param \App\User\UserFacade $userFacade
     * @param \Xervice\GithubAuth\Business\Api\GithubClientInterface $githubClient
     */
    public function __construct(
        UserFacade $userFacade,
        GithubClientInterface $githubClient
    ) {
        $this->userFacade = $userFacade;
        $this->githubClient = $githubClient;
    }

    /**
     * @param string $accessToken
     *
     * @return \DataProvider\UserDataProvider
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function addUserFromGithub(string $accessToken): UserDataProvider
    {
        $emails = $this->getFromGithub('https://api.github.com/user/emails', $accessToken);

        $primaryEmail = '';
        foreach ($emails as $email) {
            if ($email['primary'] === true) {
                $primaryEmail = $email['email'];
            }
        }

        $newUser = new UserDataProvider();
        if ($primaryEmail) {
            $newUser
                ->setEmail($primaryEmail)
                ->setPassword(md5(time().$primaryEmail))
                ->setFirstname('')
                ->setLastname('')
                ->setGithubtoken($accessToken);

            $newUser = $this->userFacade->saveUser($newUser);
        }

        return $newUser;
    }

    /**
     * @param string $url
     * @param string $accesToken
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getFromGithub(string $url, string $accesToken): array
    {
        $request = new GithubRequestDataProvider();
        $request
            ->setAccessToken($accesToken)
            ->setApiUrl($url);

        return $this->githubClient->getFromGithub($request);
    }

}