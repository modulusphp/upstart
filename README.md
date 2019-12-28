# Modulus Hibernate Component

This component is responsible for starting Craftsman and your Modulus Application.

Install
-------

This package will be automatically installed with the Modulus Framework.

```
composer require modulusphp/upstart
```

Configure
-------

To get started, add a `app.php` file in the bootstrap directory, with the following content:

```php
<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer has classes that we need to get our application running, all
| we need to do is just load it onto our script and we should be good to
| go!
|
*/

require __DIR__. '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Craft The Application
|--------------------------------------------------------------------------
|
| We first need to create a new instance of the application. Modulus
| will configure services that are needed by the rest of the application
| for you.
|
*/

$app = Modulus\Upstart\Application::boot(realpath(__DIR__ . '/../'));

$app->make(new Modulus\Upstart\Boot\BugsnagHandler);

$app->make(new Modulus\Upstart\Boot\WhoopsHandler);

$app->make(new Modulus\Upstart\Boot\EloquentHandler);

$app->make(
  new Modulus\Upstart\Boot\ApplicationServices([
    'httpFoundation' => App\Http\HttpFoundation::class,
    'handler' => App\Exceptions\Handler::class,
    'routerResolver' => App\Resolvers\RouterResolver::class,
    'appServiceResolver' => App\Resolvers\AppServiceResolver::class
  ])
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| Once the services have been loaded in the config, we will then return
| the instance of the application.
|
*/

return $app;
```

Make sure the following classes, extend:

Class | Extend
------|--------
`App\Http\HttpFoundation::class` | `Modulus\Http\Kernel::class`
`App\Exceptions\Handler::class` | `Modulus\Upstart\Exceptions\Handler::class`
`App\Resolvers\RouterResolver::class` | `Modulus\Upstart\Resolvers\Router\Service::class` 
`App\Resolvers\AppServiceResolver::class` | `Modulus\Upstart\Service::class`

Now, head over to `public/index.php` and replace the contents with:

```php
<?php

/**
 * Modulus - A cool API Framework for PHP
 *
 * @package Modulus
 * @author  Donald Pakkies <donaldpakkies@gmail.com>
 */

define('MODULUS_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| Before we can run the application, we will need to get it from the
| bootstrap, after getting it, we will be able to build a response and
| send it back to the browser.
|
*/

$app = require('../bootstrap/app.php');

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Now that we have required the application and have added our configs,
| we can send a response back to the browser. To get the response, we
| basically just need to pass our application instance to the response
| make method. So let's try it and see what we get!
|
*/

return Modulus\Upstart\Response::make($app);
```

Once that has been done, update `craftsman`:

```php
#!/usr/bin/env php
<?php

/**
 * Modulus - A cool API Framework for PHP
 *
 * @package  Modulus
 * @author   Donald Pakkies <donaldpakkies@gmail.com>
 */

define('MODULUS_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| Before we can run the application, we will need to get it from the
| bootstrap, after getting it, we will be able to build a response and
| send it back to the browser.
|
*/

/** @var \Modulus\Upstart\Application $app */
$app = require('bootstrap/app.php');

/*
|--------------------------------------------------------------------------
| Register Craftsman
|--------------------------------------------------------------------------
|
| Since we are running our application through the cli, we need to
| register a couple of commands so they can be used through the terminal.
| To get started, we just need to pass our kernel class to the console
| method. And that's pretty much it!
|
*/

$app->console(App\Console\Kernel::class);

/*
|--------------------------------------------------------------------------
| Run Craftsman
|--------------------------------------------------------------------------
|
| To get craftsman to run, we just need to pass it to the response make
| make method, "make" will return a response back to the terminal. So
| let's see if this works.
|
*/

return Modulus\Upstart\Response::make($app);
```

And that's it, your application is ignited!.

### Making everything work

Since we are replacing the old Framework core with `upstart`, we need to make sure our code base has the necessary code. 

#### App Service

```php
<?php

namespace App\Resolvers;

use Modulus\Upstart\Service;

class AppServiceResolver extends Service
{
  /**
   * Register application services
   *
   * @return void
   */
  protected function boot() : void
  {
    //
  }
}
```

#### Routes Service

```php
<?php

namespace App\Resolvers;

use Modulus\Upstart\Resolvers\Router\Service;

class RouterResolver extends Service
{
  /**
   * Redirect route after authentication
   *
   * @var string
   */
  public const HOME = '/';

  /**
   * Register application routes
   *
   * @return void
   */
  protected function boot() : void
  {
    $this->apiRoutes();
    $this->webRoutes();
  }

  /**
   * Load api routes
   *
   * @param object $app
   * @return void
   */
  protected function apiRoutes() : void
  {
    $this->route->make(base_path('routes/api.php'))
        ->middleware('api')
        ->prefix('api')
        ->register();
  }

  /**
   * Load web routes
   *
   * @return void
   */
  protected function webRoutes() : void
  {
    $this->route->make(base_path('routes/web.php'))
        ->middleware('web')
        ->register();
  }
}
```

Security
-------

If you discover any security related issues, please email donaldpakkies@gmail.com instead of using the issue tracker.

License
-------

The MIT License (MIT). Please see [License File](LICENSE) for more information.
