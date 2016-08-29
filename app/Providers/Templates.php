<?php

namespace App\Providers;

use Fol;
use Fol\ServiceProviderInterface;
use League\Plates\Engine;
use InlineSvg\Collection;

class Templates implements ServiceProviderInterface
{
    public function register(Fol $app)
    {
        $app['templates'] = function ($app) {
            $templates = new Engine($app->getPath('templates'));

            $templates->addData(['app' => $app]);

            $templates->registerFunction('asset', function () use ($app) {
            	return call_user_func_array([$app, 'getUrl'], func_get_args()).'?v1';
            });

            $svg = Collection::fromPath($app->getPath('assets/svg'));

            $templates->registerFunction('svg', function ($name) use ($svg) {
                return $svg->get($name);
            });

            $templates->registerFunction('url', function ($route, $attributes = []) use ($app) {
                $url = $app['router']->getGenerator()->generate($route, $attributes);
                return $app->getUrl($url);
            });

            return $templates;
        };
    }
}
