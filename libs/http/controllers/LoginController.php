<?php
/**
 * @author Donii Sergii <doniysa@gmail.com>
 */

namespace app\http\controllers;

use app\Controller;
use app\models\User;

/**
 * Class LoginController
 *
 * @package app\http\controllers
 *
 * @author  Donii Sergii <doniysa@gmail.com>
 */
class LoginController extends Controller
{
    protected $_layout = 'login';

    public function actionLogin() {
        var_dump(User::getById(1));
        echo $this->render('login', []);
    }
}