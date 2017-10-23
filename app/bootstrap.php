<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();


$app->register(new Silex\Provider\TwigServiceProvider(),array(
    'twig.path' => __DIR__.'/../app/views',
));

$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.base_path' => '/app'
));



$test = 'Main page';
$app->get('/', function () use ($app,$test){
    return $app['twig']->render('main.twig',array(
        'title' => $test,
    ));
});


