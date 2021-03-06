<?php

namespace App\Providers;

use Fol;
use Fol\ServiceProviderInterface;
use SimpleCrud\SimpleCrud;
use PDO;

class Database implements ServiceProviderInterface
{
    public function register(Fol $app)
    {
        $app['pdo'] = function ($app) {
            return new PDO(env('APP_DB_DSN'), env('APP_DB_USERNAME'), env('APP_DB_PASSWORD'));
        };

        $app['db'] = function ($app) {
            $db = new SimpleCrud($app['pdo']);
            $cache = $app->get('cache');
            $scheme = $cache->getItem('db_scheme');

            if (!$scheme->isHit()) {
                $scheme->set($db->getScheme());
                $cache->save($scheme);
            } else {
                $db->setScheme($scheme->get());
            }

            $db->getFieldFactory()->mapNames([
                'body' => 'Serializable',
            ]);

            $db->getTableFactory()->addNamespace($app->getNamespace('Models\\'));
            $db->setAttribute(SimpleCrud::ATTR_UPLOADS, $app->getPath('data/uploads'));

            return $db;
        };
    }
}
