<?php
/**
 * @author Donii Sergii <doniysa@gmail.com>
 */

namespace app\http\controllers;

use app\Controller;

/**
 * Class SiteController
 *
 * @package app\http\controllers
 *
 * @author  Donii Sergii <doniysa@gmail.com>
 */
class SiteController extends Controller
{
    /**
     * Index action
     *
     * @author Donii Sergii <doniysa@gmail.com>
     */
    public function actionIndex() {
        echo $this->render('index', [
            'name' => 'Mulat'
        ]);
    }
}