<?php


namespace App\GithubAuth;


use Xervice\GithubAuth\GithubAuthConfig as XerviceGithubAuthConfig;

class GithubAuthConfig extends XerviceGithubAuthConfig
{
    public const REDIRECT_BASE_URL = 'github.oauth.redirect.base.url';

    /**
     * @return string
     */
    public function getRedirectBaseUrl(): string
    {
        return $this->get(self::REDIRECT_BASE_URL);
    }
}