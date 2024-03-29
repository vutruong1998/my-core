<?php

namespace MyCore\Menu\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
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
    public function boot()
    {
        $this->publishes([
            "{$this->assetsDir}/plugins" => public_path("assets/plugins")
        ], "mc_menu_plugins");

        $this->publishes([
            "{$this->configDir}/mc_menu.php" => config_path("mc_menu.php"),
        ], "mc_menu_configs");

        $this->publishes([
            "{$this->assetsDir}/css" => public_path("assets/css"),
            "{$this->assetsDir}/fonts" => public_path("assets/fonts"),
            "{$this->assetsDir}/images" => public_path("assets/images"),
            "{$this->assetsDir}/js" => public_path("assets/js"),
        ], "mc_menu_assets");

        $this->loadViewsFrom($this->viewDir, "mc_menu");

        $this->loadMigrationsFrom($this->migrationsDir);
        $this->loadTranslationsFrom($this->translationDir, "mc_menu");
        $this->setObserves();
    }

    private function setObserves()
    {
    }
}
