<?php

/**
 * Smew - Awesome CMS based on File
 *
 * @package  Smew
 * @author   Jonathan Fontes <jonathan.alexey16@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

$app = new Gravatalonga\Smew\App(
    realpath(__DIR__.'/../')
);

$files = $app['finder'];

foreach ($files as $k => $v) {
    echo $v->getContents();
}
