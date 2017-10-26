<?php


use App\Controllers\IndexController;
use App\Models\BaseModel;
use App\Providers\CookiesServiceProvider;
use Silex\Provider\FormServiceProvider;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Class Bootstrap
 */
class Bootstrap
{

    protected $app;

    public function __construct()
    {
        $app = new Silex\Application();
        $app['debug'] = true;
        $this->app = $app;

        $this->initProviders();
        $this->initApp();
        $this->initControllers();
        $this->app->run();
    }


    protected function initProviders()
    {

        $this->app->register(new Silex\Provider\TwigServiceProvider(), array(
            'twig.path' => __DIR__ . '/../app/views',
        ));

        $this->app->register(new Silex\Provider\AssetServiceProvider());

        $this->app->register(new Silex\Provider\DoctrineServiceProvider(), array(
            'db.options' => array(
                'driver' => 'pdo_sqlite',
                'path' => __DIR__ . '/resources/app.db',
            ),
        ));
        $this->app->register(new Sorien\Provider\PimpleDumpProvider());
        $this->app->register(new FormServiceProvider());
        $this->app->register(new Silex\Provider\ValidatorServiceProvider());
        $this->app->register(new Silex\Provider\TranslationServiceProvider(), array(
            'translator.domains' => array(),
        ));
        $this->app->register(new Silex\Provider\LocaleServiceProvider());

        $this->app->register(new CookiesServiceProvider());
    }

    protected function initApp()
    {
        $app = $this->app;
        $model = new BaseModel();
        $model::setDb($app['db']);
    }

    protected function initControllers()
    {
        $app = $this->app;
        $app->mount('/', new IndexController());
    }
}