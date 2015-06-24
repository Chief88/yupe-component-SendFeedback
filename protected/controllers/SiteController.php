<?php
/**
 * Дефолтный контроллер сайта:
 *
 * @category YupeController
 * @package  yupe.controllers
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3 (dev)
 * @link     http://yupe.ru
 *
 **/
namespace application\controllers;

use Imagine\Imagick\Image;
use yupe\components\controllers\FrontController;

class SiteController extends FrontController
{

    public function beforeAction(){
        if (\Yii::app()->hasModule('feedback')){
            \Yii::app()->sendFeedback->send([
                'scenario' => 'callback',
                'themes' => 'Обратный звонок',
                'modelName' => '\CallBackForm',
            ]);
        }
        return true;
    }


    /**
     * Отображение главной страницы
     *
     * @return void
     */
    public function actionIndex()
    {
        $this->render('index');
    }

}
