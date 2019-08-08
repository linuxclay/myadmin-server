<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $routes = [
        'api' => [
            'v1' => [
                'domain'     => '*',
                'prefix'     => 'api/example/v1',
                'namespace'  => 'App\Http\Controllers\Api\V1',
                'middleware' => ['api'],
                'api'        => true,
                'files'      => [
                    'routes/api/example/v1/ping.php',
                ],
            ],
        ],
        'common' => [
            'pulbics' => [
                'domain'     => '*',
                'prefix'     => 'common',
                'namespace'  => 'App\Http\Controllers\Common',
                'middleware' => ['common'],
                'api'        => true,
                'files'      => [
                    'routes/common/publics.php',
                ],
            ],
        ],
        'web' => [
            'errors' => [
                'domain'     => '*',
                'prefix'     => 'error',
                'namespace'  => 'App\Http\Controllers\Web',
                'middleware' => ['web'],
                'api'        => false,
                'files'      => [
                    'routes/web/error.php',
                ],
            ],
        ]
    ];

    /**
     * Define your route model bindings, pattern filters, etc.

     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        foreach ($this->routes as $group => $route)
        {
            $this->mapRoutes($route);
        }
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param $routes
     * @return void
     * @throws AppException
     */
    protected function mapRoutes($routes)
    {
        foreach ($routes as $group => $route)
        {
            if (starts_with(request()->path(), $route['prefix']))
            {
                if ($route['api'] ?? false) config(['api.response' => true]);
            }

            if (! ($domain = $route['domain'] == '*' ? '*' : config($route['domain'] , null)))
            {
                continue;
            }

            if ($domain == '*') $domain = '';

            foreach ($route['files'] as $file)
            {
                Route::middleware($route['middleware'] ?? [])
                    ->domain($domain)
                    ->prefix($route['prefix'])
                    ->namespace($route['namespace'])
                    ->group(base_path($file));
            }
        }
    }
}
