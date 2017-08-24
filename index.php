<?php
/**
 * @author Donii Sergii <doniysa@gmail.com>
 */

require __DIR__ . '/vendor/autoload.php';

use app\App;

$config = require __DIR__ . '/config.php';


$app = App::getInstance($config);
$app->run();