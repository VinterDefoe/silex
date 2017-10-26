<?php

namespace App\Controllers;

use App\Forms\ReviewForm;
use App\Models\ReviewModel;
use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;
use Silex\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends BaseController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $index = new ControllerCollection(new Route());

        $index->get('/',function () use ($app){
            $model = new ReviewModel();
            $result = $model->getAllReviews();
            return $app['twig']->render('index.twig',[
                'result' => $result,
            ]);
        });

        $index->get('/{id}',function($id) use ($app){
            $model = new ReviewModel();
            $result = $model->getReview($id);
            return $app['twig']->render('review.twig',[
                'result' => $result,
            ]);
        });

        $index->get('/review/',function (Request $request) use ($app){

            $data = array(
                'name' => 'Your name',
                'email' => 'Your email',
            );

            $form = $app['form.factory']->createBuilder(FormType::class, $data)
                ->add('name')
                ->add('email')
                ->add('billing_plan', ChoiceType::class, array(
                    'choices' => array('free' => 1, 'small business' => 2, 'corporate' => 3),
                    'expanded' => true,
                ))
                ->add('submit', SubmitType::class, [
                    'label' => 'Save',
                ])
                ->getForm();

            $form->handleRequest($request);

            return $app['twig']->render('addReview.twig', array('form' =>$form->createView()));
        });

        return $index;
    }
}