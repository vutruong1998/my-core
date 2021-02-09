<?php

namespace MyCore\Core\Providers;

use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use MyCore\Core\Repositories\RoleRepository;
use MyCore\Core\Repositories\RoleRepositoryEloquent;
use MyCore\Core\Repositories\UserRepository;
use MyCore\Core\Repositories\UserRepositoryEloquent;

class CoreServiceProvider extends ServiceProvider {
    private $rootDir;
    private $viewDir;
    private $configDir;
    private $assetsDir;
    private $migrationsDir;
    private $translationDir;

    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        UserRepository::class => UserRepositoryEloquent::class,
        RoleRepository::class => RoleRepositoryEloquent::class
    ];

    public function __construct($app)
    {
        parent::__construct($app);
        $this->rootDir = realpath(__DIR__ . "/../");
        $this->viewDir = "{$this->rootDir}/resources/views";
        $this->configDir = "{$this->rootDir}/configs";
        $this->assetsDir = "{$this->rootDir}/assets";
        $this->migrationsDir = "{$this->rootDir}/database/migrations";
        $this->translationDir = "{$this->rootDir}/resources/lang";
    }

    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->aliasMiddleware('role', RoleMiddleware::class);
        $router->aliasMiddleware('permission', PermissionMiddleware::class);
        $router->aliasMiddleware('role_or_permission', RoleOrPermissionMiddleware::class);

        $this->publishes([
            "{$this->configDir}/mc_core.php" => config_path("mc_core.php"),
        ], "mc_core_configs");

        $this->publishes([
            "{$this->assetsDir}/css" => public_path("assets/css"),
            "{$this->assetsDir}/fonts" => public_path("assets/fonts"),
            "{$this->assetsDir}/images" => public_path("assets/images"),
            "{$this->assetsDir}/js" => public_path("assets/js"),
        ], "mc_core_assets");

        $this->loadViewsFrom($this->viewDir, "mc_core");

        $this->loadMigrationsFrom($this->migrationsDir);
        $this->loadTranslationsFrom($this->translationDir, "mc_core");
        $this->setObserves();
    }

    private function setObserves()
    {
    }
}
