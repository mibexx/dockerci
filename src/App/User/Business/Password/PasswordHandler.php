<?php


namespace App\User\Business\Password;


use DataProvider\UserDataProvider;

class PasswordHandler implements PasswordHandlerInterface
{
    private const ALGORYTHM = PASSWORD_BCRYPT;

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return \DataProvider\UserDataProvider
     */
    public function encrypt(UserDataProvider $userDataProvider): UserDataProvider
    {
        return $userDataProvider->setPassword(
            password_hash(
                $userDataProvider->getPassword(),
                self::ALGORYTHM
            )
        );
    }

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return bool
     */
    public function validate(UserDataProvider $userDataProvider, string $password): bool
    {
        return password_verify($password, $userDataProvider->getPassword());
    }
}