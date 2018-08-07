<?php
declare(strict_types=1);

namespace App\Application\Plugins\Routing;


use App\DockerCi\Communication\Controller\IndexController;
use App\GithubAuth\Communication\Controller\GithubController;
use DataProvider\RouteCollectionDataProvider;
use Xervice\Controller\Business\Route\AbstractControllerProvider;

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
         $this->addRoute('/github/login', GithubController::class, 'indexAction', ['GET']);
         $this->addRoute('/github/auth', GithubController::class, 'authAction', ['GET']);
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