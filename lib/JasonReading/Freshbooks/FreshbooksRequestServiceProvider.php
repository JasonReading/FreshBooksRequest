<?php

namespace JasonReading\Freshbooks;

use Silex\Application;
use Silex\ServiceProviderInterface;

class FreshbooksRequestServiceProvider implements ServiceProviderInterface
{
    function register(Application $app)
    {
        $app['freshbooks.options'] = array(
            'domain' => NULL,
            'token' => NULL,
        );

        $app['freshbooks'] = $app->protect(function ($command) use ($app) {
            FreshBooksRequest::init($app['freshbooks.domain'], $app['freshbooks.token']);
            $freshbooks = new FreshBooksRequest($command);
            return $freshbooks;
        });

    }

    function boot(Application $app)
    {
    }
}
