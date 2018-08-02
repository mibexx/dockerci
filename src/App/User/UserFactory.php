<?php
declare(strict_types=1);

namespace App\User;


use App\User\Business\Reader\UserReader;
use App\User\Business\Reader\UserReaderInterface;
use App\User\Business\Writer\UserWriter;
use App\User\Business\Writer\UserWriterInterface;
use Xervice\Core\Factory\AbstractFactory;

/**
 * @method \App\User\UserConfig getConfig()
 */
class UserFactory extends AbstractFactory
{
    /**
     * @return \App\User\Business\Writer\UserWriterInterface
     */
    public function createUserWriter(): UserWriterInterface
    {
        return new UserWriter(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \App\User\Business\Reader\UserReaderInterface
     */
    public function createUserReader(): UserReaderInterface
    {
        return new UserReader(
            $this->getQueryContainer()
        );
    }
    
    /**
     * @return \App\User\UserQueryContainer
     */
    public function getQueryContainer(): UserQueryContainer
    {
        return $this->getDependency(UserDependencyProvider::USER_QUERY);
    }
}