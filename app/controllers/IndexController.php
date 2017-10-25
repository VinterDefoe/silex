<?php

namespace App\Controllers;

use App\Models\ReviewModel;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\Route;

class IndexController extends BaseController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $index = new ControllerCollection(new Route());

        $index->get('/',function () use ($app){
            $model = new ReviewModel();
            $result = $model->getAllReviews();
            return $app['twig']->render('index.twig', array(
                'result' => $result,
            ));
        });

        return $index;
    }
}