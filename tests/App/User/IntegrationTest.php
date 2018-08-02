<?php
namespace XerviceTest\User;

use DataProvider\UserDataProvider;
use Xervice\Core\Locator\Dynamic\DynamicLocator;
use Xervice\Core\Locator\Locator;

/**
 * @method \App\User\UserFacade getFacade()
 */
class IntegrationTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    /**
     * @var UserDataProvider
     */
    private $testUser;

    /**
     * @Override
     */
    protected function _before()
    {
        Locator::getInstance()->kernel()->facade()->boot();

        $this->testUser = new UserDataProvider();
        $this->testUser
            ->setEmail('myunit-test.test.de')
            ->setPassword('myPassword')
            ->setFirstname('Unit')
            ->setLastname('Test')
            ->setCompany('My Test Company');

        $this->testUser = $this->getFacade()->saveUser($this->testUser);
    }

    /**
     * @Override
     */
    protected function _after()
    {
        $deleteUser = new UserDataProvider();
        $deleteUser->setUserId($this->testUser->getUserId());

        $this->getFacade()->deleteUser($deleteUser);
    }

    /**
     * @group App
     * @group User
     * @group Integration
     */
    public function testReadUserById()
    {
        $userDataProvider = new UserDataProvider();
        $userDataProvider->setUserId($this->testUser->getUserId());
        $user = $this->getFacade()->getUser($userDataProvider);

        $this->assertEquals(
            $this->testUser->getEmail(),
            $user->getEmail()
        );
    }

    /**
     * @group App
     * @group User
     * @group Integration
     */
    public function testReadUserByEmail()
    {
        $userDataProvider = new UserDataProvider();
        $userDataProvider->setEmail($this->testUser->getEmail());
        $user = $this->getFacade()->getUser($userDataProvider);

        $this->assertEquals(
            $this->testUser->getFirstname(),
            $user->getFirstname()
        );
    }
}