<?php
declare(strict_types=1);
namespace App\User\Business\Writer;

use DataProvider\UserDataProvider;

interface UserWriterInterface
{
    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @return \DataProvider\UserDataProvider
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function writeUser(UserDataProvider $userDataProvider): UserDataProvider;

    /**
     * @param \DataProvider\UserDataProvider $userDataProvider
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function deleteUser(UserDataProvider $userDataProvider): void;
}