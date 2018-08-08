<?php
declare(strict_types=1);

namespace App\Application\Plugins\Routing;


use App\DockerCi\Communication\Controller\IndexController;
use DataProvider\RouteCollectionDataProvider;
use Xervice\Controller\Business\Route\AbstractControllerProvider;
use Xervice\GithubAuth\Communication\Controller\GithubController;
use Xervice\GithubAuth\GithubAuthConfig;

class Routing extends AbstractControllerProvider
{
    /**
     * @var RouteCollectionDataProvider
     */
    private $dataProvider;

    /**
     * @param \DataProvider\RouteCollectionDataProvider $dataProvider
     *
     * @return \DataProvider\RouteCollectionDataProvider
     */
    public function handleRoutes(RouteCollectionDataProvider $dataProvider): RouteCollectionDataProvider
    {
        $this->dataProvider = $dataProvider;
        $this->defineRoutes();
        return $this->dataProvider;
    }

    protected function defineRoutes(): void
    {
         $this->addRoute('/', IndexController::class, 'indexAction', ['GET']);
         $this->addRoute('/register', UserController::class, 'registerAction', ['GET', 'POST']);
         $this->addRoute('/login', UserController::class, 'loginAction', ['POST']);
         $this->addRoute('/logout', UserController::class, 'logoutAction', ['GET']);

         $this->addRoute(GithubAuthConfig::LOGIN_PATH, GithubController::class, 'githubLoginAction', ['GET']);
         $this->addRoute(GithubAuthConfig::AUTH_PATH, GithubController::class, 'githubAuthAction', ['GET']);
         $this->addRoute(GithubAuthConfig::ERROR_PATH, GithubController::class, 'githubError', ['GET']);
    }

    /**
     * @param string $path
     * @param string $controller
     * @param string $action
     * @param array $methods
     */
    protected function addRoute(string $path, string $controller, string $action, array $methods)
    {
        $this->dataProvider->addRoute(
            $this->addController(
                $path,
                $controller,
                $action,
                $methods
            )
        );
    }
}