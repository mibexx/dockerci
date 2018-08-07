<?php
declare(strict_types=1);
namespace App\User\Business\Writer;

use DataProvider\UserDataProvider;

interface UserWriterInterface
{
    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @param bool $overwrite
     *
     * @return \DataProvider\UserDataProvider
     */
    public function writeUser(UserDataProvider $userDataProvider, bool $overwrite): UserDataProvider;

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteUser(UserDataProvider $userDataProvider): void;
}